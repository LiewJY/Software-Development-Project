<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Room;

use App\Models\ReservationPayment;

class Reservations extends Component
{
    use WithPagination;
    public $ReservationForm = false;
    public $deleteConfirmationForm = false;
    //public $room_id, $room_slot_id, $payment_id, $reservation_date, $payment_status, $name, $customer_name;
    public $search = '';
    protected $queryString = ['search'];

    public $selectedLocation, $selectedDate, $selectedRoom, $selectedSlot = null;
    public $locations, $rooms, $slots, $price, $amount, $balance;
    public $customer_id, $reservationID;


    /**
     * Return blade view
     *
     * @return void
     */
    public function render()
    {
        return view(
            'livewire.employee.reservations',
            [
                'reservations' => Reservation::where('customers.last_name', 'like', '%' . $this->search . '%')
                ->where('customers.first_name', 'like', '%' . $this->search . '%')
                ->join('reservation_payments', 'reservations.reservation_payment_id', '=', 'reservation_payments.id')
                ->join('customers', 'reservation_payments.customer_id', '=', 'customers.id')
                ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                ->join('slots', 'reservations.slot_id', '=', 'slots.id')
                ->paginate(10)
            ], [
                'customers' => Customer::all(),
                'location' =>Location::all(),
            ]
        );
    }

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules = [
        'selectedLocation' => ['required'],
        'selectedDate' => ['required', 'date_format:Y/m/d'],
        'selectedRoom' => ['required'],
        'selectedSlot' => ['required'],
        'customer_id' => ['required'],
        'amount' => ['required', 'regex:/^\d+\.\d{1,2}/', 'not_in:0']

    ];


    /**
     * Update or create reservation
     *
     * @return void
     */
    public function store()
    {

        $this->validate();

        if (!is_null($this->reservationID)) {
            $reservation = Reservation::find($this->reservationID);
            $id = $reservation->reservationpayment->pluck('id');
        } else {
            $id = NULL;
        }

        $payment = ReservationPayment::updateOrCreate(['id' => $id], [
            'customer_id' => $this->customer_id,
            'amount' => $this->amount,
        ]);

        $reservation = Reservation::updateOrCreate(['id' => $this->reservation_ID], [
            'room_id' => $this->selectedRoom,
            'slot_id' => $this->selectedSlot,
            'reservation_date' => $this->selectedDate,
        ]);

        $payment->reservation()->save($reservation);
        $this->ReservationForm = false;
    }

    /**
     * Reset component properties when adding a new reservation.
     *
     * @return void
     */
    public function add()
    {
        $this->reset();
        $this->ReservationForm = true;
    }

    /**
     * Load rooms based on selected date
     *
     * @return void
     */
    public function updatedSelectedDate()
    {
        $this->rooms = Room::where('location_id', $this->selectedLocation)->get();
        $this->selectedRoom = NULL;
    }

    /**
     * Load available slots based on selected room
     *
     * @param  mixed $room
     * @return void
     */
    public function updatedSelectedRoom($room)
    {
        if (!is_null($room)) {
            $reserved = Reservation::where('reservation_date', $this->selectedDate)->pluck('room_id')->toArray();
            $room = Room::find($this->selectedRoom);
            $roomSlots = $room->slots->pluck('id')->toArray();
            $this->slots = array_diff($roomSlots, $reserved);
            $this->price = $room->price;
        }
    }
}

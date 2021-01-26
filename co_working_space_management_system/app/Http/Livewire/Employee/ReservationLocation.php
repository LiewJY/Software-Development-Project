<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Room;
use App\Models\ReservationPayment;
use App\Models\Slot;

class ReservationLocation extends Component
{
    use WithPagination;
    public $ReservationForm = false;
    public $deleteConfirmationForm = false;
    public $search = '';
    protected $queryString = ['search'];

    public $selectedLocation, $selectedDate, $selectedRoom, $selectedSlot = null;
    public $locations, $rooms, $slots, $price, $amount, $balance;
    public $customer_id, $reservationID;

    public $location, $loc_name, $location_id;

    public function mount($id)
    {
        $this->location_id = $id;
        $this->selectedLocation = $id;
        $location = Location::findorFail($id);
        $this->loc_name = $location->name;
    }
    /**
     * Return blade view
     *
     * @return void
     */
    public function render()
    {
        return view(
            'livewire.employee.reservation-location',
            [
                'reservations' => Reservation::where('customers.last_name', 'like', '%' . $this->search . '%')
                    ->where('customers.first_name', 'like', '%' . $this->search . '%')
                    ->join('reservation_payments', 'reservations.reservation_payment_id', '=', 'reservation_payments.id')
                    ->join('customers', 'reservation_payments.customer_id', '=', 'customers.id')
                    ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                    ->join('slots', 'reservations.slot_id', '=', 'slots.id')
                    ->select('reservations.id as reservation_id', 'reservations.*', 'customers.*', 'reservation_payments.*', 'rooms.*', 'slots.*')
                    ->where('rooms.location_id', '=', $this->location_id)
                    ->paginate(10)
            ],
            [
                'customers' => Customer::all(),
                'location' => Location::all(),
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
        'selectedDate' => ['required'],
        'selectedRoom' => ['required'],
        'selectedSlot' => ['required'],
        'customer_id' => ['required'],
        'amount' => ['required', 'regex:/^\d+\.\d{1,2}/', 'not_in:0'],
        'balance' => ['required', 'int']
    ];

    /**
     * Custominze error message
     *
     * @var array
     */
    protected $messages = [
        'balance.regex' => 'Balance could not be in negetive value.',
        'amount.regex' => 'Please enter a valid amount.',
        'amount.not_in' => 'Please enter a valid amount.'
    ];

    /**
     * Live validation
     *
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    /**
     * Update or create reservation
     *
     * @return void
     */
    public function store()
    {
        $this->validate();

        $payment = ReservationPayment::create([
            'customer_id' => $this->customer_id,
            'amount_paid' => $this->amount,
            'balance' => $this->balance
        ]);

        $reservation = Reservation::create([
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
        $this->reset('selectedDate', 'selectedRoom', 'selectedSlot', 'locations', 'rooms', 'slots', 'price', 'amount', 'balance', 'customer_id', 'reservationID');
        $this->ReservationForm = true;
    }

    /**
     * Load rooms based on selected date
     *
     * @return void
     */
    public function updatedSelectedLocation()
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
            $reserved = Reservation::where('reservation_date', $this->selectedDate)->pluck('slot_id')->toArray();
            $room = Room::find($this->selectedRoom);
            $roomSlots = $room->slots->pluck('id')->toArray();
            $array = array_diff($roomSlots, $reserved);
            $this->slots = Slot::select('*')->whereIn('id', $array)->get();
            $this->price = $room->price;
        }
    }

    /**
     * Update balance
     *
     * @param  int $amount
     * @return void
     */
    public function updatedAmount($amount)
    {
        $this->balance = $amount - $this->price;
    }
    public $name, $room, $date, $return;

    /**
     * show the delete modal
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteModal($id)
    {
        $this->deleteConfirmationForm = true;
        $reservation = Reservation::findorFail($id);
        $this->reservationID = $id;
        $name = $reservation->reservationpayment->customer;
        $this->name = $name['first_name'] . ' ' . $name['last_name'];
        $this->room = $reservation->room->name;
        $this->date = $reservation->reservation_date;
        $this->return = $reservation->reservationpayment->amount;
    }

    /**
     * Delete selected reservation
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        $reservation = Reservation::where('id', $id)->firstorfail();
        $reservation->delete();
        $this->deleteConfirmationForm = false;
    }
}

<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\RoomSlot;
use App\Models\Room;
use App\Models\Slot;
use App\Models\ReservationPayment;

class Reservations extends Component
{
    use WithPagination;
    public $ReservationForm = false;
    public $deleteConfirmationForm = false;
    public $room_id, $room_slot_id, $payment_id, $reservation_date, $payment_status, $name, $customer_name;
    public $search = '';
    protected $queryString = ['search'];

    public $selectedLocation, $selectedDate, $selectedRoom, $selectedSlot = null;
    public $locations, $rooms, $slots;
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
                'customers' => Customer::all(),

                'reservations' => Reservation::where('customers.last_name', 'like', '%' . $this->search . '%')
                    ->join('customers', 'reservations.customer_id', '=', 'customers.id')
                    ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                    ->join('slots', 'reservations.room_slot_id', '=', 'slots.id')
                    ->join('payments', 'reservations.payment_id', '=', 'payments.id')
                    ->select('reservations.*', 'customers.last_name as customer_last_name', 'customers.first_name as customer_first_name', 'rooms.name as room_name', 'slots.start_time as slot_start', 'slots.end_time as slot_end', 'payments.amount as payments_amount')
                    ->paginate(10)
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

    public function edit($id)
    {
        $this->ReservationForm = true;
        $this->reservationID = $id;
        $reservation = Reservation::where('id', $id)->firstorfail();
        $customer = ReservationPayment::where('id', $reservation->reservationpayment->pluck('id'))->first();

        $res_info = Reservation::join('payments', 'reservations.payment_id', '=', 'payments.id')
            ->join('customers', 'customers.id', '=', 'reservations.customer_id')
            ->where('reservations.id', '=', $this->reservationID)
            ->first();

        $this->customer_name = $customer->customer->first_name . ' ' . $customer->customer->last_name;
        $this->room_id = $res_info->name;
        $this->room_slot_id = $res_info['start_time'] . ' ' . $res_info['end_name'];
        $this->payment_id = $res_info->amount;
        $this->reservation_date = $res_info->reservation_date;
        $this->payment_status = $res_info->payment_status;
        $this->customer_id = $res_info->customer_id;
    }

    /**
     * cancle selected reservations
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        $reservation = Reservation::where('id', $id)->firstorfail();
        ReservationPayment::where('id', $reservation->reservation_payment_id)->firstorfail()->delete();
        $this->deleteConfirmationForm = false;
    }


    /**
     * Delete modal 
     *
     * @param  int $id
     * @return void
     */
    public function deleteModal($id)
    {
        $this->deleteConfirmationForm = true;
        $reservation = Reservation::findorFail($id);
        $this->reservationID = $id;
        $reserves = Reservation::join('customers', 'reservations.customer_id', '=', 'customers.id')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->where('reservations.id', '=', $this->reservationID)
            ->select('reservations.*', 'rooms.*', 'customers.*')
            ->first();
        $this->name = $reserves['first_name'] . ' ' . $reserves['last_name'] . ', ' . $reserves['name'];
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
        }
    }
}

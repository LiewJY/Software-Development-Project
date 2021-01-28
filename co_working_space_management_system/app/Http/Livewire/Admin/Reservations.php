<?php

namespace App\Http\Livewire\Admin;

use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Room;
use App\Models\ReservationPayment;
use App\Models\Slot;
use App\Models\User;

use Livewire\Component;

class Reservations extends Component
{
    use WithPagination;
    public $ReservationForm = false;
    public $deleteConfirmationForm = false;
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
            'livewire.admin.reservations',
            [
                'reservations' => Reservation::where(function ($query) {
                    $query->where('customers.last_name', 'like', '%' . $this->search . '%')
                        ->orwhere('customers.first_name', 'like', '%' . $this->search . '%');
                })
                    ->join('reservation_payments', 'reservations.reservation_payment_id', '=', 'reservation_payments.id')
                    ->join('customers', 'reservation_payments.customer_id', '=', 'customers.id')
                    ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                    ->join('slots', 'reservations.slot_id', '=', 'slots.id')
                    ->select('reservations.id as reservation_id', 'reservations.*', 'customers.*', 'reservation_payments.*', 'rooms.*', 'slots.*')
                    ->where('reservations.reservation_date', '>=', date("y-m-d"))
                    ->paginate(10)
            ],
            [
                'customers' => Customer::all(),
                'location' => Location::all(),
            ]
        )->layout('layouts.page');
    }
    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules = [
        'selectedLocation' => ['required'],
        'selectedDate' => ['required', 'date', "after_or_equal:today"],
        'selectedRoom' => ['required'],
        'selectedSlot' => ['required'],
        'customer_id' => ['required'],
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
            'amount' => $this->amount,
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
        $this->reset();
        $this->ReservationForm = true;
    }

    /**
     * Check if the customer has any subscription , if yes load the location's room
     *
     * @return void
     */
    public function updatedCustomerId()
    {
        $customer = Customer::find($this->customer_id);
        if (User::find($customer->user_id)->membership_payments->first() == null || User::find($customer->user_id)->membership_payments->first()->updated_at->addDays(30)->isPast()) {
            session()->flash('error', 'Selected customer does not have any active subscription.');
        } else {
            $this->rooms = Room::where('location_id', $this->selectedLocation)->get();
            $this->selectedRoom = NULL;
        }
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
        $reservation = Reservation::find($id);
        ReservationPayment::find($reservation->reservation_payment_id)->delete();
        $this->deleteConfirmationForm = false;
    }

    /**
     * open receipt
     *
     * @param  mixed $id
     * @return void
     */
    public function print($id)
    {
        return redirect()->route('printreservation', ['id' => $id]);
    }
}

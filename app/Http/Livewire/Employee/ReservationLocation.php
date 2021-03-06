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
use App\Models\User;

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

    public $location, $location_id, $expired;
    public $ongoingMaintenance = [];

    public function mount($id)
    {
        $this->location_id = $id;
        $this->selectedLocation = $id;
        $this->location = Location::findorFail($id);
    }

    /**
     * Show all upcoming reservations on selected locations
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view(
            'livewire.employee.reservation-location',
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
                    ->where('rooms.location_id', '=', $this->location_id)
                    ->paginate(10)
            ],
            [
                'customers' => Customer::all(),
            ]
        )->layout('layouts.page');
    }



    /**
     * Validation rules
     *
     * @return array
     */
    public function rules()
    {

        return [
            'selectedLocation' => ['required'],
            'selectedDate' => ['required', 'date', 'after_or_equal:today', 'before_or_equal:' . $this->expired],
            'selectedRoom' => ['required'],
            'selectedSlot' => ['required'],
            'customer_id' => ['required'],
        ];
    }


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
            'amount' => $this->price,
        ]);

        $reservation = Reservation::create([
            'room_id' => $this->selectedRoom,
            'slot_id' => $this->selectedSlot,
            'reservation_date' => $this->selectedDate,
        ]);

        $payment->reservation()->save($reservation);
        $this->ReservationForm = false;
        session()->flash('success', 'Reservation successfully created.');
        return redirect()->route('reservationlocation', $this->location_id);
    }

    /**
     * Reset component properties when adding a new reservation.
     *
     * @return void
     */
    public function add()
    {
        $this->reset('selectedDate', 'selectedRoom', 'selectedSlot', 'locations', 'rooms', 'slots', 'price', 'amount', 'balance', 'customer_id', 'reservationID');
        $this->resetErrorBag();
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
        if (User::find($customer->user_id)->membership_payments->first() == null || User::find($customer->user_id)->membership_payments->sortByDesc('created_at')->first()->expired_on->isPast()) {
            session()->flash('error', 'Selected customer does not have any active subscription.');
        } else {

            $location = Location::find($this->selectedLocation)->maintenances()->where('status', 0)->get();
            foreach ($location as $room) {
                array_push($this->ongoingMaintenance, $room->room_id);
            }

            $customer = Customer::find($this->customer_id);
            $this->expired = User::find($customer->user_id)->membership_payments->sortByDesc('created_at')->first()->expired_on->toDateString();

            $this->rooms = Room::where('location_id', $this->selectedLocation)->whereNotIn('id', $this->ongoingMaintenance)->get();
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
        session()->flash('success', 'Reservation successfully canceled.');
        return redirect()->route('reservationlocation', $this->location_id);
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

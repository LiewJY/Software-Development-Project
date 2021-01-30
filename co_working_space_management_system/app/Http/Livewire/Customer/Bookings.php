<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Location;
use App\Models\ReservationPayment;
use App\Models\Slot;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

class Bookings extends Component
{   
    use WithPagination;
    //public $search = '';
    //protected $queryString = ['search'];
    //public $customer_id, $room_id, $payment_id, $reservation_date, $payment_status; 
    public $selectedLocation, $selectedDate, $selectedRoom, $selectedSlot = null;
    public $locations, $rooms, $slots, $price;

    public $bookingID, $user_id, $customer_name, $customer_id;
    public $bookingsForm = false;
    public $deleteConfirmationForm = false;
    public $ongoingMaintenance = [];

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules = [
        'selectedLocation' => ['required'],
        'selectedDate' => ['required', "date", "after_or_equal:today"],
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


    public function render()
    {
        $this->user_id = Auth::user()->id;
        $customer_info = Customer::where('user_id', $this->user_id)->select('customers.*')->first();
        $this->customer_id = $customer_info->id;

        return view(
            'livewire.customer.bookings',
            [
                'bookings' => Reservation::join('reservation_payments', 'reservations.reservation_payment_id', '=', 'reservation_payments.id')
                    ->join('customers', 'reservation_payments.customer_id', '=', 'customers.id')
                    ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                    ->join('slots', 'reservations.slot_id', '=', 'slots.id')
                    ->join('locations', 'rooms.location_id', '=', 'locations.id')
                    ->select('reservations.id as booking_id', 'reservations.*', 'customers.*', 'reservation_payments.*', 'rooms.*', 'slots.*', 'locations.name as locations_name')
                    ->where('reservation_payments.customer_id', '=', $this->customer_id)
                    ->where('reservations.reservation_date', '>=', date("y-m-d"))
                    ->paginate(10)
            ],
            [
                'location' => Location::all(),
            ]
        )->layout('layouts.page');
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
            'amount' => $this->price
        ]);

        $reservation = Reservation::create([
            'room_id' => $this->selectedRoom,
            'slot_id' => $this->selectedSlot,
            'reservation_date' => $this->selectedDate,
        ]);

        $payment->reservation()->save($reservation);
        $this->bookingsForm = false;
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
        // $reservation->delete();
        $this->deleteConfirmationForm = false;
    }


    public function add()
    {
        if (Auth::user()->membership_payments->sortByDesc('expired_on')->first() == null || Auth::user()->membership_payments->sortByDesc('created_at')->first()->expired_on->isPast()) {
            session()->flash("error", "You dont have any active subscription. Please subscribe to any available plans before proceeding.");
        } else {
            $this->reset();
            $this->user_id = Auth::user()->id;
            $customer_info = Customer::where('user_id', $this->user_id)->select('customers.*')->first();
            $this->customer_name = $customer_info['last_name'] . ' ' . $customer_info['first_name'];
            $this->customer_id = $customer_info->id;
            $this->bookingsForm = true;
        }
    }

    /**
     * Load rooms based on selected date
     *
     * @return void
     */
    public function updatedSelectedLocation()
    {

        $location = Location::find($this->selectedLocation)->maintenances()->where('status', 0)->get();
        foreach ($location as $room) {
            array_push($this->ongoingMaintenance, $room->room_id);
        }

        $this->rooms = Room::where('location_id', $this->selectedLocation)->whereNotIn('id', $this->ongoingMaintenance)->get();
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

    public function deleteModal($id)
    {
        $this->deleteConfirmationForm = true;
        $this->bookingID = $id;
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

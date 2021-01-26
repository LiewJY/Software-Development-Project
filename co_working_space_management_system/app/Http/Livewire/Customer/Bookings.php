<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Location;
use App\Models\Slot;



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

    public function render()
    {
        $this->user_id = Auth::user()->id;
        $customer_info = Customer::where('user_id', $this->user_id)->select('customers.*')->first();
        $this->customer_id = $customer_info->id;

        return view('livewire.customer.bookings', [
            'bookings' => Reservation::join('reservation_payments', 'reservations.reservation_payment_id', '=', 'reservation_payments.id')
            ->join('customers', 'reservation_payments.customer_id', '=', 'customers.id')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->join('slots', 'reservations.slot_id', '=', 'slots.id')
            ->join('locations', 'rooms.location_id', '=', 'locations.id')
            ->select('reservations.id as booking_id', 'reservations.*', 'customers.*', 'reservation_payments.*', 'rooms.*', 'slots.*', 'locations.name as locations_name')
            ->where('reservation_payments.customer_id', '=', $this->customer_id)
            ->paginate(10)
        ],
        [
            'location' => Location::all(),
            ]);
    }

    public function add()
    {
        $this->reset();
        $this->user_id = Auth::user()->id;
        $customer_info = Customer::where('user_id', $this->user_id)->select('customers.*')->first();
        $this->customer_name = $customer_info['last_name'].' '. $customer_info['first_name'];
        $this->customer_id = $customer_info->id;
        $this->bookingsForm = true;

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

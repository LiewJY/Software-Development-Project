<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Reservation;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;


class BookingHistory extends Component
{
    public $user_id, $customer_id;


    public function render()
    {
        $this->user_id = Auth::user()->id;
        $customer_info = Customer::where('user_id', $this->user_id)->select('customers.*')->first();
        $this->customer_id = $customer_info->id;

        return view('livewire.customer.booking-history', [
            'bookings' => Reservation::join('reservation_payments', 'reservations.reservation_payment_id', '=', 'reservation_payments.id')
            ->join('customers', 'reservation_payments.customer_id', '=', 'customers.id')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->join('slots', 'reservations.slot_id', '=', 'slots.id')
            ->join('locations', 'rooms.location_id', '=', 'locations.id')
            ->select('reservations.id as booking_id', 'reservations.*', 'customers.*', 'reservation_payments.*', 'rooms.*', 'slots.*', 'locations.name as locations_name')
            ->where('reservation_payments.customer_id', '=', $this->customer_id)
            ->where('reservations.reservation_date', '<', date("y-m-d"))
            ->paginate(10)
        ]);
    }
    public function add()
    {
        return redirect()->route('bookings');
    }

}

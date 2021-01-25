<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Room;


class Bookings extends Component
{
    use WithPagination;
    public $search = '';
    protected $queryString = ['search'];
    public $customer_id, $room_id, $payment_id, $reservation_date, $payment_status, $reservationID;
    public $membershipForm = false;
    public $deleteConfirmationForm = false;

    public function render()
    {
        return view('livewire.customer.bookings', [
            'bookings' => Reservation::where('customers.first_name', 'like', '%' . $this->search . '%')
            ->join('customers', 'reservations.customer_id', '=', 'customers.id')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->select('reservations.*', 'customers.first_name as customer_name')
            ->paginate(10),
            ]);
    }

    public function add()
    {
        $this->reset();
        $this->membershipForm = true;
    }

    public function delete($id)
    {
        $bookings = Reservation::where('id', $id)->firstorfail();
        $bookings->delete();
        $this->deleteConfirmationForm = false;
    }

    public function deleteModal($id)
    {
        $this->deleteConfirmationForm = true;
        $this->reservationID = $id;
        $booking = Customer::findorFail($id);
        $this->first_name = $booking ->first_name;
    }
}

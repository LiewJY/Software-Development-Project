<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\RoomSlot;
use App\Models\Room;
use App\Models\Slot;
use App\Models\Payment;


class Reservations extends Component
{
    use WithPagination;
    public $ReservationForm = false;
    public $deleteConfirmationForm = false;
    public $customer_id, $room_id, $room_slot_id, $payment_id, $reservation_date, $payment_status, $reservationID, $name, $customer_name;
    public $search = '';
    protected $queryString = ['search'];

    protected $rules = [
        'customer_id' => ['required', 'string', 'max:255'],
        'room_id' => ['required', 'string'],
        'room_slot_id' => ['required', 'string'],
        'payment_id' => ['required', 'string'],
        'reservation_date' => ['required'],
        'payment_status' => ['required'],
    ];

    public function render()
    {
        return view('livewire.employee.reservations', [
            'reservations' => reservation::where('customers.last_name', 'like', '%' . $this->search . '%')
            ->join('customers', 'reservations.customer_id', '=', 'customers.id')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->join('slots', 'reservations.room_slot_id', '=', 'slots.id')
            ->join('payments', 'reservations.payment_id', '=', 'payments.id')
            ->select('reservations.*', 'customers.last_name as customer_last_name', 'customers.first_name as customer_first_name','rooms.name as room_name', 'slots.start_time as slot_start','slots.end_time as slot_end', 'payments.amount as payments_amount')
            ->paginate(10)
        ], [
            'customers' => Customer::select('customers.first_name as first_name', 'customers.last_name as last_name')
            ->get(),
            'rooms' => Room::select('rooms.name as room_name')
            ->get(),
            'slots' => Slot::select('slots.start_time as slot_start', 'slots.end_time as slot_end')
            ->get() 
        ]); 
    }


    public function add()
    {
        $this->reset();
        $this->ReservationForm = true;
    }

    public function store()
    {
       $validatedData = $this->validate();

       $customers = Customer::updateOrCreate([
            'customer_name'=> $this->first_name,
            'customer_name'=> $this->last_name
        ]);

        $reserves = Reservation::updateOrCreate([
            'reservation_date' => $this->reservation_date,
            'payment_status'=> $this->payment_status
        ]);

        $room = Room::updateOrCreate([
            'room_id'=> $this->room_name
        ]);

        $payments = Payment::updateOrCreate([
            'payment_id'=> $this->payment_amount
        ]);
        
        $this->ReservationForm = false;

        session()->flash(
            'message',
            $this->reservationID ? 'Reservation Updated Successfully.' : 'Reservation Created Successfully.'
        );
    }

    public function update()
    {
        $validatedData = $this->validate([
            'customers' => ['required'],
            'rooms' => ['required'],
            'slots' => ['required'],
        ]);

        $reserves = Reservation::findorFail($this->reservationID);
        $reserves->update($validatedData);


        $this->employeeForm = false;
    }

    /**
     * Pass reservation id and it will fill the feilds with data from database
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        $this->ReservationForm = true;
        $reservation = Reservation::findOrFail($id);
        $this->reservationID = $id;

        $res_info = Reservation::join('payments', 'reservations.payment_id', '=', 'payments.id')
        ->join('customers', 'customers.id', '=', 'reservations.customer_id')
        ->where('reservations.id', '=', $this->reservationID)
        ->first();

        $this->customer_name = $res_info['last_name'].' '. $res_info['first_name'];
        $this->room_id = $res_info->name;
        $this->room_slot_id = $res_info['start_time'].' '. $res_info['end_name'];
        $this->payment_id = $res_info->amount;
        $this->reservation_date = $res_info->reservation_date;
        $this->payment_status = $res_info->payment_status;
        $this->customer_id = $res_info->customer_id;
    }


    public function deleteModal($id)
    {
        $this->deleteConfirmationForm = true;
        $reservation = Reservation::findorFail($id);
        $this->reservationID = $id;
        $reserves = Reservation::join('customers', 'reservations.customer_id', '=', 'customers.id')
        ->join('rooms','reservations.room_id','=','rooms.id')
        ->where('reservations.id', '=', $this->reservationID)
        ->select('reservations.*', 'rooms.*' , 'customers.*')
        ->first();
        $this->name = $reserves['first_name']. ' ' .$reserves['last_name']. ', ' .$reserves['name'];
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
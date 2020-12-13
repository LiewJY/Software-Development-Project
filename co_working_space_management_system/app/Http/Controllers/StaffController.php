<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        return view('admin.staff');
    }

    public function resetInpurField()
    {
    }

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'requried|email|unique:users',
    ];

    public function create()
    {

        $this->validate();

        $user = User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'roles' => $this->role
        ]);

        $employee = Employee::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'contact_number' => $this->contact_number,

        ]);

        $user->employee()->save($employee);
        $this->closeModal();
    }

    public function delete($id)
    {
        $employee =  Employee::where('id', $id)->firstorfail();
        User::where('id', $employee->user_id)->firstorfail()->delete();
    }

    public function edit($id)
    {
        $employee = Employee::findorFail($id);
        $this->firstName =  $employee->first_name;
        $this->lastName = $employee->last_name;
        $this->address = $employee->address;
        $this->contactNumber =  $employee->contact_number;

        $this->openCard();
    }

    public function openCard()
    {
        $this->isOpen = true;
    }

    public function closeCard()
    {
        $this->isOpen = false;
    }
}

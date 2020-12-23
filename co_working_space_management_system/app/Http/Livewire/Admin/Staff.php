<?php

namespace App\Http\Livewire\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Employee;
use App\Models\User;
use Livewire\Component;
use tidy;

class Staff extends Component
{

    use PasswordValidationRules;

    public $username, $email, $password, $roles, $firstName, $lastName, $address, $contactNumber;

    /**
     * Employee creation validation rules
     *
     * @var array
     */
    protected $rules = [
        'username' => 'required' | 'string' | 'min:6' | 'max:255' | 'unique:users',
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'roles' => ['required'],
        'firstName' => ['required', 'string', 'max:255'],
        'lastName' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string', 'max:255'],
        'contactNumber' => ['required', 'regex:/^(01)[0-46-9]*[0-9]{7,8}$/']
    ];


    public function render()
    {
        return view('livewire.admin.staff');
    }

    /**
     * Creating or updating existing employee data
     *
     * @return void
     */
    public function store()
    {
        $this->validate([
            'password'  => $this->passwordRules()
        ]);

        $userID = Employee::where('id', $this->employeeID)->first();

        if ($userID) {
            $this->userID = $userID->user_id;
        }

        $user = User::updateorCreate(['id' => $this->userID], [
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'roles' => $this->roles
        ]);

        $employee = Employee::updateorCreate(['user_id' => $this->userID], [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'address' => $this->address,
            'contact_number' => $this->contactNumber,
        ]);

        $user->employee()->save($employee);
    }

    /**
     * Fill feilds with employee data from database
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        $employee = Employee::findorFail($id);
        $this->firstName =  $employee->first_name;
        $this->lastName = $employee->last_name;
        $this->address = $employee->address;
        $this->contactNumber =  $employee->contact_number;
    }

    /**
     * Delete selected employee
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        $employee =  Employee::where('id', $id)->firstorfail();
        User::where('id', $employee->user_id)->firstorfail()->delete();
    }
}

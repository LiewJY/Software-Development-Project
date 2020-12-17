<?php

namespace App\Http\Controllers;

us  e App\Models\Employee;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        return view('admin.staff');
    }

    /**
     * Validation rules that applied in creating and updating employee data.
     *
     * @var array
     */
    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'requried|email|unique:users',
    ];

    /**
     * Create or Update employee details
     *
     * @return void
     */
    public function create()
    {

        $this->validate();

        $userID = Employee::where('id', $this->employeeID)->first();

        if ($userID) {
            $this->userID = $userID->user_id;
        }

        $user = User::updateorCreate(['id' => $this->userID], [
            'username' => 'testing123342',
            'email' => 'testing@gmail.com',
            'password' => bcrypt('testing'),
            'roles' => '0'
        ]);

        $employee = Employee::updateorCreate(['user_id' => $this->userID], [
            'first_name' => 'testing312312',
            'address' => 'testing',
            'last_name' => 'testing',
            'contact_number' => '16854',
        ]);

        $user->employee()->save($employee);
    }

    /**
     * Deleting employee.
     * Employee ID will be null in maintenance table upon delete
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        $employee =  Employee::where('id', $id)->firstorfail();
        User::where('id', $employee->user_id)->firstorfail()->delete();
    }

    /**
     * Update employee information
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
}

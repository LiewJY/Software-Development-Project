<?php

namespace App\Http\Livewire\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;
use App\Models\User;

class Staff extends Component
{
    use WithPagination;
    use PasswordValidationRules;
    public $employeeForm = false;
    public $employeeAddForm = false;
    public $deleteConEmployeeForm = false;
    public $username, $email, $password, $roles, $first_name, $last_name, $address, $contact_number, $employeeID;
    public $search = '';
    protected $queryString = ['search'];

    /**
     * Employee creation validation rules
     *
     * @var array
     */
    protected $rules = [
        'username' => ['required', 'string', 'min:6', 'max:255', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        // 'roles' => ['required'],
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string', 'max:255'],
        'contact_number' => ['required', 'regex:/^(01)[0-46-9]*[0-9]{7,8}$/' ],
        'password'  => [
            'required',
            'min:8',
        ]
    ];


    public function render()
    {
        return view('livewire.admin.staff', [
            'employees' => employee::where('first_name', 'like', '%' . $this->search . '%')->paginate(10),
        ]);
    }

    public function add()
    {
        $this->reset();
        $this->employeeAddForm = true;
    }

    /**
     * Creating or updating existing employee data
     *
     * @return void
     */
    public function store()
    {
        $this->validate();

        if ($this->employeeID) {
            $userID = Employee::where('id', $this->employeeID)->first();
            $this->userID = $userID->user_id;
        } else {
            $this->userID = NULL;
        }


        $user = User::updateorCreate(['id' => $this->userID], [
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'roles' => $this->roles
        ]);

        $employee = Employee::updateorCreate(['user_id' => $this->userID], [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'contact_number' => $this->contact_number,
        ]);

        $user->employee()->save($employee);

        $this->employeeForm = false;
        $this->employeeAddForm = false;
    }

    /**
     * Fill feilds with employee data from database
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        $this->employeeForm = true;
        $employee = Employee::findorFail($id);
        $this->employeeID = $id;
        $this->first_name =  $employee->first_name;
        $this->last_name = $employee->last_name;
        $this->address = $employee->address;
        $this->contact_number =  $employee->contact_number;
    }

    public function deleteModal($id, $first_name)
    {
        $this->deleteConEmployeeForm = true;
        $this->employeeID = $id;
        $this->first_name = $first_name;
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
    
    /**
     * Real time validation
     *
     * @return void
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}

<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;

class Staff extends Component
{
    use WithPagination;
    public $employeeForm = false;
    public $deleteConEmployeeForm = false;
    public $first_name, $last_name, $address, $contactNumber, $employeeID;
    public $search = '';
    protected $queryString = ['search'];

    /**
     * Validation rules that are applied to location 
     *
     * @var array
     */
    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'address' => 'required|max:255',
        'contactNumber' => 'required|regex:/^(01)[0-46-9]*[0-9]{7,8}$/',
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
        $this->employeeForm = true;
        
    }

    /**
     * Create or update location 
     *
     * @return void
     */
    public function store()
    {
        $this->validate();

        Employee::updateOrCreate(['id' => $this->employeeID], [
            'first_name' => $this->first_name,
            'last_name' =>  $this->last_name,
            'address' => $this->address,
            'contact_number' => $this->contactNumber
        ]);
        $this->employeeForm = false;


        session()->flash(
            'message',
            $this->employeeID ? 'Location Updated Successfully.' : 'Location Created Successfully.'
        );
    }

    /**
     * Pass location id and it will fill the feilds with data from database
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        $this->employeeForm = true;
        $employee = Employee::findOrFail($id);
        $this->employeeID = $id;
        $this->first_name = $employee->first_name;
        $this->last_name = $employee->last_name;
        $this->address = $employee->address;
        $this->contactNumber = $employee->contact_number;
    }

    public function deleteModal($id, $first_name)
    {
        $this->deleteConEmployeeForm = true;
        $this->employeeID = $id;
        $this->first_name = $first_name;
        
    }
    /**
     * Delete selected location
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        Employee::where('id', $id)->delete();
        $this->deleteConEmployeeForm = false;
    }
}
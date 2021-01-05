<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer;
use App\Models\User;


class Customers extends Component
{
    use WithPagination;
    public $search = '';
    protected $queryString = ['search'];
    public $username, $roles, $first_name, $last_name, $address, $contact_number, $customerID, $users_id, $email, $password;
    public $customerForm = false;
    public $deleteConfirmationForm = false;

    protected $rules = [
        
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string', 'max:255'],
        'contact_number' => ['required', 'regex:/^(01)[0-46-9]*[0-9]{7,8}$/'],
    ];
    
    public function render()
    {
        return view('livewire.employee.customers', [
            'customers' => customer::where('customers.first_name', 'like', '%' . $this->search . '%')
                ->orWhere('customers.last_name', 'like', '%' . $this->search . '%')
                ->join('users', 'customers.user_id', '=', 'users.id')
                //->select('customers.*', 'users.roles', 'users.username', 'users.email')
                ->paginate(10),
        ]);
    }
    public function add()
    {
        $this->reset();
        $this->customerForm = true;
    }

    public function store()
    {
        $this->validate();
 
        $user = User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'roles' => $this->roles,
        ]);
 
        $customer = Customer::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'contact_number' => $this->contact_number,
        ]);
 
        $user->customer()->save($customer);
 
        $this->customerForm = false;
    }
    

    /**
     * Update customer data
     *
     * @return void
     */
    public function update()
    {
        $validatedData = $this->validate([
            'address' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'regex:/^(01)[0-46-9]*[0-9]{7,8}$/'],
        ]);

        $customer = customer::findorFail($this->customerID);
        $customer->update($validatedData);

        $this->customerForm = false;
    }

    /**
     * Fill feilds with customer data from database
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        $this->customerForm = true;
        $customer = customer::findorFail($id);
        $this->customerID = $id;
        $this->first_name =  $customer->first_name;
        $this->last_name = $customer->last_name;
        $this->address = $customer->address;
        $this->contact_number =  $customer->contact_number;
        $this->users_id = $customer->user_id;
        $this->username = $customer->user->username;
        $this->roles = $customer->user->roles;
        $this->email = $customer->user->email;
    }
    public function deleteModal($id, $name)
    {
        $this->deleteConfirmationForm = true;
        $this->customerID = $id;
        $this->first_name =  $name;
    }
    /**
     * Delete selected employee
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        $customer =  customer::where('id', $id)->firstorfail();
        User::where('id', $customer->user_id)->firstorfail()->delete();
        $this->deleteConfirmationForm = false;
    }

}

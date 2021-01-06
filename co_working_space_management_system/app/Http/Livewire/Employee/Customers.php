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

    /**
     * Validation rules
     *
     * @var array
     */
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
                ->paginate(10),
        ]);
    }

    public function add()
    {
        $this->reset();
        $this->customerForm = true;
        $this->roles = 0;
    }

    /**
     * Creation of new customer
     *
     * @return void
     */
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
}

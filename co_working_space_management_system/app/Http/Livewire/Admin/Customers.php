<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer;

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
        return view('livewire.admin.customers', [
            'customers' => customer::where('customers.first_name', 'like', '%' . $this->search . '%')
                ->orWhere('customers.last_name', 'like', '%' . $this->search . '%')
                ->join('users', 'customers.user_id', '=', 'users.id')
                ->paginate(10),
        ])->layout('layouts.page');
    }
}

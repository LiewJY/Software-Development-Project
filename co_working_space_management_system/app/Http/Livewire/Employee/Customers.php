<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer;

class Customers extends Component
{
    use WithPagination;
    public $search = '';
    protected $queryString = ['search'];

    /**
     * Show customer page
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.employee.customers', [
            'customers' => customer::where('customers.first_name', 'like', '%' . $this->search . '%')
                ->orWhere('customers.last_name', 'like', '%' . $this->search . '%')
                ->join('users', 'customers.user_id', '=', 'users.id')
                ->paginate(10),
        ])->layout('layouts.page');
    }
}

<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use App\Models\Location;
use Livewire\WithPagination;



class Maintenances extends Component
{
    use WithPagination;
    public $search = '';
    protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.employee.maintenances', [
            'locations' => Location::where('locations.name', 'like', '%' . $this->search . '%')->get()
        ]);
    }
    public function room($location)
    {
        return redirect()->route('employeeroom', ['id' => $location]);
    }



}

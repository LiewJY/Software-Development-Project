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
    
    /**
     * Show location with maintenance count
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view(
            'livewire.employee.maintenances',
            [
                'locations' => Location::where('locations.name', 'like', '%' . $this->search . '%')->get()
            ]
        )->layout('layouts.page');
    }    

    /**
     * Redirect to maintenance room page
     *
     * @param  int $location
     * @return \Illuminate\View\View
     */
    public function room($location)
    {
        return redirect()->route('employeeroom', ['id' => $location]);
    }
}

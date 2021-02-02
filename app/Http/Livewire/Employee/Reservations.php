<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use App\Models\Location;


class Reservations extends Component
{
    public $search = '';
    protected $queryString = ['search'];

    /**
     * Show location with reservation count
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view(
            'livewire.employee.reservations',
            [
                'locations' => Location::where('locations.name', 'like', '%' . $this->search . '%')->get()
            ]
        )->layout('layouts.page');
    }

        
    /**
     * Redirect to show all location's reservations page
     *
     * @param  int $location
     * @return \Illuminate\View\View
     */
    public function room($location)
    {
        return redirect()->route('reservationlocation', ['id' => $location]);
    }
}

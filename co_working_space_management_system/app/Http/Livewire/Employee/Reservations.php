<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use App\Models\Location;


class Reservations extends Component
{
    public $search = '';
    protected $queryString = ['search'];
    /**
     * Return blade view
     *
     * @return void
     */
    public function render()
    {
        return view(
            'livewire.employee.reservations',
            [
                'locations' => Location::where('locations.name', 'like', '%' . $this->search . '%')->get()
            ]
        );
    }
    public function room($location)
    {
        return redirect()->route('reservationlocation', ['id' => $location]);
    }

}

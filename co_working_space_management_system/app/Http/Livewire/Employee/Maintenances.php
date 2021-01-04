<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Location;
use App\Models\Room;


class Maintenances extends Component
{
    use WithPagination;
    public $search = '';
    public $test, $tea, $val,$haha, $location;
    protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.employee.maintenances', [
            'locations' => location::where('name', 'like', '%' . $this->search . '%')->get(),
        ]);
    }
    public function room($location_id)
    {
        return redirect()->route('employeeroom', ['id' => $location_id]);
    }

}

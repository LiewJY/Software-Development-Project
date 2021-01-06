<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Room;
use App\Models\Location;
use App\Models\Maintenance;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class MaintenanceRoom extends Component
{
    use WithPagination;
    public $location_id, $location;
    public $room_id, $employee_id, $description, $status, $maintenance_id, $employee_name, $name, $room_name;
    public $maintenanceForm = false;
    public $completeConfirmationForm = false;
    public $search = '';
    protected $queryString = ['search'];

    /**
     * validation rules
     *
     * @var array
     */
    protected $rules = [
        'room_id' => ['required'],
        'employee_id' => ['required'],
        'description' => ['required', 'max:255', 'string'],
        'status' => ['required', 'boolean']
    ];

    public function mount($id)
    {
        $this->location_id = $id;
        $this->location = Location::findorFail($id);
    }

    public function render()
    {
        return view('livewire.employee.maintenance-room', [
            'maintenances' => maintenance::where('rooms.name', 'like', '%' . $this->search . '%')
                ->join('rooms', 'maintenances.room_id', '=', 'rooms.id')
                ->join('locations', 'rooms.location_id', '=', 'locations.id')
                ->select('maintenances.*', 'rooms.name as room_name', 'locations.name as location_name', 'locations.id as location_id')
                ->where('rooms.location_id', '=', $this->location_id)
                ->where('maintenances.status', '=', '0')
                ->paginate(10)
        ], [
            'rooms' => room::where('rooms.location_id', '=', $this->location_id)
                ->get()
        ]);
    }


    /**
     * Reset properties values
     *
     * @return void
     */
    public function add()
    {
        $this->reset('maintenance_id');
        $this->reset('maintenance_id', 'room_id', 'employee_id', 'description', 'status', 'employee_name', 'name');
        $this->user = Auth::user()->id;
        $employee_info = Employee::where('user_id', $this->user)->select('employees.*')->first();
        $this->employee_name = $employee_info['last_name'] . ' ' . $employee_info['first_name'];
        $this->employee_id = $employee_info->id;
        $this->maintenanceForm = true;
        $this->status = 0;
    }

    /**
     * Update or create maintenance
     *
     * @return void
     */
    public function store()
    {
        $validatedData = $this->validate();

        Maintenance::updateOrCreate(
            ['id' => $this->maintenance_id],
            $validatedData
        );
        $this->maintenanceForm = false;
        $this->completeConfirmationForm = false;
    }


    /**
     * Edit form 
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        $this->maintenanceForm = true;
        $maintenance = Maintenance::findorFail($id);
        $this->maintenance_id = $id;
        $this->room_id = $maintenance->room_id;
        $this->room_name = $maintenance->room->name;
        $this->description = $maintenance->description;
        $this->status = $maintenance->status;
        $this->employee_name = $maintenance->employee->first_name . ' ' . $maintenance->employee->last_name;
        $this->employee_id = Employee::where('user_id', Auth::user()->id)->first()->id;
    }

    /**
     * Mark maintenance as complete
     *
     * @param  int $id
     * @return void
     */
    public function markAsComplete($id)
    {
        $this->completeConfirmationForm = true;
        $maintenance = Maintenance::findorFail($id);
        $this->room_name = $maintenance->room->name;
        $this->maintenance_id = $id;
        $this->room_id = $maintenance->room_id;
        $this->employee_id = Employee::where('user_id', Auth::user()->id)->first()->id;
        $this->description = $maintenance->description;
        $this->status = 1;
    }
}

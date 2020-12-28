<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Maintenance;
use App\Models\Room;
use App\Models\Location;
use App\Models\Employee;



use Illuminate\Support\Facades\Auth;

class Maintenances extends Component
{
    use WithPagination;
    public $search = '';
    protected $queryString = ['search'];
    public $room_id, $employee_id, $description, $status, $maintenance_id, $employee_name, $name;
    public $maintenanceForm = false;
    public $deleteConfirmationForm = false;
    protected $employeeID;

    protected $rules = [
        'room_id' => ['required'],
        'employee_id' => ['required'],
        'description' => ['required', 'max:255', 'string'],
        'status' => ['required', 'boolean']
    ];
    
    public function render()
    {
        return view('livewire.admin.maintenances', [
            'maintenances' => maintenance::where('rooms.name', 'like', '%' . $this->search . '%')
            ->join('rooms', 'maintenances.room_id', '=', 'rooms.id')
            ->join('locations', 'rooms.location_id', '=', 'locations.id')
            ->join('employees', 'maintenances.employee_id', '=', 'employees.id')
            ->select('maintenances.*', 'rooms.name as room_name', 'locations.name as location_name', 'locations.id as location_id', 'employees.first_name as employee_first_name')
            ->paginate(10)
        ], [
            'rooms' => room::join('locations', 'rooms.location_id', '=', 'locations.id')
            ->select('rooms.*', 'locations.name as location_name')
            ->get()

        ]);       
    }

    public function add()
    {
        $this->reset();
        $this->user = Auth::user()->id;
        $employee_info = Employee::where('user_id', $this->user)->select('employees.*')->first();
        $this->employee_name = $employee_info['first_name'].' '. $employee_info['last_name'];
        $this->employee_id = $employee_info->id;
        $this->maintenanceForm = true;
    }

    public function store()
    {
        $validatedData = $this->validate();
        
        Maintenance::updateOrCreate(
            ['id' => $this->maintenance_id],
            $validatedData
        );
        $this->maintenanceForm = false;

    }
    

    public function edit($id)
    {
        $this->maintenanceForm = true;
        $maintenance = Maintenance::findorFail($id);
        $this->maintenance_id = $id;
        $this->room_id = $maintenance->room_id;
        $this->user = Auth::user()->id;
        $employee_info = Employee::where('user_id', $this->user)->select('employees.*')->first();
        $this->employee_name = $employee_info['first_name'].' '. $employee_info['last_name'];
        $this->employee_id = $employee_info->id;
        $this->description = $maintenance->description;
        $this->status = $maintenance->status;

    } 
    public function deleteModal($id)
    {
        $this->deleteConfirmationForm = true;
        $maintenance = Maintenance::findorFail($id);
        $room = room::join('locations', 'rooms.location_id', '=', 'locations.id')
        ->select('rooms.*', 'locations.name as location_name')
        ->first();
        $this->name = $room['name'].', '.$room['location_name'];
        $this->maintenance_id = $maintenance->id;
    }

    public function delete($id)
    {
        $maintenance = Maintenance::where('id', $id)->firstorfail();
        $maintenance->delete();
        $this->deleteConfirmationForm = false;
    }
}
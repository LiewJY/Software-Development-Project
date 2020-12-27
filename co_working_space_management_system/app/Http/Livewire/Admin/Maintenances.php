<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Maintenance;
use App\Models\Room;

use Illuminate\Support\Facades\Auth;

class Maintenances extends Component
{
    use WithPagination;
    public $search = '';
    protected $queryString = ['search'];
    public $room_id, $employee_id, $description, $status, $maintenance, $location, $rooms;
    public $maintenanceForm = false;
    public $deleteConfirmationForm = false;
    protected $employeeID;

    protected $rules = [
        'description' => ['required', 'max:255', 'string'],
        'status' => ['required', 'boolean']
    ];
    
    public function render()
    {
        if(!empty($this->locaiton)){
            $this->rooms = room::where('location_id', $this->location)->get();
        }
        return view('livewire.admin.maintenances', [
            'maintenances' => maintenance::where('rooms.name', 'like', '%' . $this->search . '%')
            ->join('rooms', 'maintenances.room_id', '=', 'rooms.id')
            ->join('locations', 'rooms.location_id', '=', 'locations.id')
            ->join('users', 'maintenances.employee_id', '=', 'users.id')
            ->select('maintenances.*', 'rooms.name as room_name', 'locations.name as location_name', 'users.username as employee_name')
            ->paginate(10),
        ]);


        
    }
    public function add()
    {
        $this->reset();
        $this->maintenanceForm = true;
        
    }
    public function store()
    {
        $this->validate();
        
        $this->employee_id = Auth::user()->id;

        Maintenance::updateOrCreate(
            ['id' => $this->locationID],
            [
                'employee_id' => $this->employee_id,
                'description' => $this->description,
                'status' => $this->status
            ]
        );
    }

    public function edit($id)
    {
        
        $this->maintenanceForm = true;
        $maintenance = Maintenance::findorFail($id);
        $this->employee_id =  Auth::user()->id;
        $this->room_id = $maintenance->room_id;
        $this->description = $maintenance->description;
        $this->price = $maintenance->price;
        $this->size =  $maintenance->size;
    } 
    public function deleteModal($id)
    {
        $maintenance = Maintenance::findorFail($id);
        $this->deleteConfirmationForm = true;
        $this->employee_id = $id;
        $this->description = $maintenance->description;
        $this->price = $maintenance->price;
        $this->size =  $maintenance->size;
    }

    public function delete($id)
    {
        $maintenance = Maintenance::where('id', $id)->firstorfail();
        $maintenance->delete();
        $this->deleteConfirmationForm = false;
    }
}
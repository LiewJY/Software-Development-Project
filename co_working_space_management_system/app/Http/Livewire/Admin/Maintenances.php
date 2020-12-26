<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Maintenance;
use Illuminate\Support\Facades\Auth;

class Maintenances extends Component
{
    use WithPagination;
    public $search = '';
    protected $queryString = ['search'];
    public $locationID, $name;
    public $room_id, $employee_id, $description, $status, $maintenance;
    public $maintenanceForm = false;
    public $deleteConfirmationForm = false;
    protected $employeeID;

    protected $rules = [
        'description' => ['required', 'max:255', 'string'],
        'status' => ['required', 'boolean']
    ];
    
    public function render()
    {
        
        return view('livewire.admin.maintenances', [
            'maintenances' => maintenance::where('room_id', 'like', '%' . $this->search . '%')->paginate(10),
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
        
        $this->employeeID = Auth::user()->id;

        Maintenance::updateOrCreate(
            ['id' => $this->locationID],
            [
                'employee_id' => $this->employeeID,
                'description' => $this->description,
                'status' => $this->status
            ]
        );
    }

    public function edit($id)
    {
        
        $this->maintenanceForm = true;
        $maintenance = Maintenance::findorFail($id);
        $this->employeeID =  Auth::user()->id;
        $this->description = $maintenance->description;
        $this->price = $maintenance->price;
        $this->size =  $maintenance->size;
    } 
    public function deleteModal($id)
    {
        $maintenance = Maintenance::findorFail($id);
        $this->deleteConfirmationForm = true;
        $this->employeeID = $id;
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
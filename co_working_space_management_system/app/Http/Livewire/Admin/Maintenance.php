<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Maintenance extends Component
{

    public $roomID, $description, $status;

    protected $employeeID;

    protected $rules = [
        'description' => ['required', 'max:255', 'string'],
        'status' => ['required', 'boolean']
    ];

    public function render()
    {
        return view('livewire.admin.maintenance');
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
        $maintenance = Maintenance::findorFail($id);
        $this->employeeID =  Auth::user()->id;
        $this->description = $maintenance->description;
        $this->price = $maintenance->price;
        $this->size =  $maintenance->size;
    } 

    public function delete($id)
    {
        $maintenance = Maintenance::where('id', $id)->firstorfail();
        $maintenance->delete();
    }
}
}

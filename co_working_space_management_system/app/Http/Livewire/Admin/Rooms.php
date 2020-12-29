<?php

namespace App\Http\Livewire\Admin;


use App\Models\Room;
use Livewire\Component;

class Rooms extends Component
{
    public $haha = false;
    public $name, $locationID,  $description, $price, $size, $roomID;

    /**
     * validation rules that applied to room
     *
     * @var array
     */
    protected $rules = [
        'name' => ['required', 'string', 'max:55'],
        'description' => ['requried', 'string', 'max:255', 'min:10'],
        'price' => ['required', 'reges:\d+\.\d{1,2}', 'not_in:0'],
        'size' => ['required', 'numeric']
    ];

    public function render()
    {
        return view('livewire.admin.rooms');
    }

    public function test()
    {
        $this->haha = true;
    }

    /**
     * Create or update existing room
     *
     * @return void
     */
    public function store()
    {
        $validatedData = $this->validate(
            ['locationID' => ['required']]
        );

        Room::updateOrCreate(
            ['id' => $this->roomID],
            $validatedData
        );
    }

    /**
     * Fill fields with room details from database
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        $room = Room::findorFail($id);
        $this->name =  $room->name;
        $this->description = $room->description;
        $this->price = $room->price;
        $this->size =  $room->size;
    }

    /**
     * Delete selected room
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        $room = Room::where('id', $id)->firstorfail();
        $room->delete();
    }

}

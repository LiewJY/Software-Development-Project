<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Rooms extends Component
{
    public $haha = false;
    public function render()
    {
        return view('livewire.admin.rooms');
    }
    public function test()
    {
        $this->haha = true;
    }
}

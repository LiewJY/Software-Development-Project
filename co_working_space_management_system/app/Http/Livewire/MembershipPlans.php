<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;
class MembershipPlans extends Component
{
    public function render()
    {
        $memberships = DB::select('SELECT * FROM memberships');
        return view('livewire.membership-plans', ['memberships' => $memberships]);
    }
}

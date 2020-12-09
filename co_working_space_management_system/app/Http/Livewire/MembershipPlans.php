<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;
class MembershipPlans extends Component
{
    public function render()
    {
        $memberships = Membership::all();
        return view('livewire.membership-plans', ['memberships' => $memberships]);
    }
}

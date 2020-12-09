<?php

namespace App\Http\Livewire;

use App\Models\Membership;
use Livewire\Component;

class MembershipPlans extends Component
{
    public function render()
    {
        $memberships = Membership::all();
        return view('livewire.membership-plans', ['memberships' => $memberships]);
    }
}

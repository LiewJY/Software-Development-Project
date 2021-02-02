<?php

namespace App\Http\Livewire;

use App\Models\Membership;
use Livewire\Component;

class MembershipPlans extends Component
{    
    /**
     * Show all membership plans
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $memberships = Membership::all();
        return view('livewire.membership-plans', ['memberships' => $memberships])->layout('layouts.page');
    }
    
    /**
     * Redirect to payment page
     *
     * @param  int $plans
     * @return \Illuminate\View\View
     */
    public function membership($plans)
    {
        return redirect()->route('membershipPlans', ['id' => $plans]);
    }
}

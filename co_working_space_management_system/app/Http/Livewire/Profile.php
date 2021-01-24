<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;

class Profile extends UpdateProfileInformationForm
{

    public function mount()
    {
        if (Auth::user()->roles == 2) {
            $this->state = User::with("customer")->find(3)->toArray();
        } else {
            $this->state = User::with("employee")->find(Auth::user()->id)->toArray();
        }
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('profile.update-profile-information-form');
    }
}

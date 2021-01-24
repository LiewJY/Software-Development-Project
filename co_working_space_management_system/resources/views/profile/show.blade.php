@extends('layouts.page')
@section('content')

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profile
        </h2>
    </div>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif
            

        <div class="md:grid md:grid-cols-3 md:gap-6">
            <x-jet-section-title>
                <x-slot name="title">Menbership status</x-slot>
                <x-slot name="description">Each membership subscription will last 30 days.</x-slot>
            </x-jet-section-title>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                show membership subscription
                            </div>
                            {{-- @if ($this->user->membership_payments->first() == null)
                                No subscription
                            @else

                                @if ($this->user->membership_payments->first()->updated_at->addDays(30)->isPast())
                                
                                    No subscription
                                
                                @elseif ($this->user->membership_payments->first()->updated_at->addDays(30)->isToday())
                                
                                    {{$this->user->membership_payments->first()->membership->first()->name}}
                                
                                @else
                                
                                    {{$this->user->membership_payments->first()->membership->first()->name}}
                                
                                @endif

                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-jet-section-border />
           

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>
        </div>
    </div>
@endsection
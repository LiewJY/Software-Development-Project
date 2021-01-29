<x-app-layout >
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="font-bold text-xl md:text-2xl">Profile</h1>
</div>

<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 bg-gray-50">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        @livewire('profile')

        <x-jet-section-border />
        @endif

        @if(Auth::user()->roles == 2)
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
                                    @if (Auth::user()->membership_payments->first() == null)
                                    No subscription
                                    @else

                                    @if (Auth::user()->membership_payments->first()->updated_at->addDays(30)->isPast())

                                    No subscription

                                    @elseif (Auth::user()->membership_payments->first()->updated_at->addDays(30)->isToday())

                                    {{Auth::user()->membership_payments->first()->membership->first()->name}}

                                    @else

                                    {{Auth::user()->membership_payments->first()->membership->first()->name}}

                                    @endif

                                    @endif
                                </div>
                            </div>
                        </div>
                    {{-- <div class="flex items-center justify-end px-4 py-3 bg-gray-100 text-right sm:px-6">
                        <x-jet-button >Print Invoice</x-jet-button>
                    </div> --}}
                    </div>

                </div>
            </div>
            <x-jet-section-border />
        @endif


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

</x-app-layout>

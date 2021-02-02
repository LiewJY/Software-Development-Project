<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        @if(Auth::user()->roles == 2)
        {{-- name --}}
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="firstName" value="{{ __('FIrst name') }}" />
            <x-jet-input id="firstName" type="text" class="mt-1 block w-full" wire:model.lazy="state.customer.first_name" />
            <x-jet-input-error for="customer.first_name" />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="lastName" value="{{ __('Last Name') }}" />
            <x-jet-input id="lastName" type="text" class="mt-1 block w-full" wire:model.defer="state.customer.last_name" />
            <x-jet-input-error for="customer.last_name" />
        </div>
        {{-- address --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="address" value="{{ __('Address') }}" />
            <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="state.customer.address" />
            <x-jet-input-error for="customer.address" />
        </div>
        {{-- contact number --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="contact_number" value="{{ __('Contact Number') }}" />
            <x-jet-input id="contact_number" type="text" class="mt-1 block w-full" wire:model.defer="state.customer.contact_number" />
            <x-jet-input-error for="customer.contact_number" />
        </div>
        @else
        {{-- name --}}
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="firstName" value="{{ __('First name') }}" />
            <x-jet-input id="firstName" type="text" readonly class="mt-1 block w-full" wire:model.lazy="state.employee.first_name" />
            <x-jet-input-error for="first_name" />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="lastName" value="{{ __('Last name') }}" />
            <x-jet-input id="lastName" type="text" readonly class="mt-1 block w-full" wire:model.defer="state.employee.last_name" />
            <x-jet-input-error for="last_name" />
        </div>
        {{-- address --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="address" value="{{ __('Address') }}" />
            <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="state.employee.address" />
            <x-jet-input-error for="address" />
        </div>
        {{-- contact number --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="contact_number" value="{{ __('Contact Number') }}" />
            <x-jet-input id="contact_number" type="text" class="mt-1 block w-full" wire:model.defer="state.employee.contact_number" />
            <x-jet-input-error for="contact_number" />
        </div>

        @endif
        <!-- Username -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="username" value="{{ __('Username') }}" />
            <x-jet-input id="username" readonly type="text" class="mt-1 block w-full" wire:model.defer="state.username" autocomplete="username" />
            <x-jet-input-error for="username" class="mt-2" />
        </div>

        <!-- Email -->
        @if(Auth::user()->roles == 2)
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
        @else 
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" readonly class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
        @endif
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>

</x-jet-form-section>
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        {{-- <x-jet-validation-errors class="mb-4" /> --}}

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="flex justify-between gap-3">
                <span class="w-1/2">
                    <x-jet-label for="firstName" value="First name" />
                    <x-jet-input id="firstName" type="text" class="mt-1 block w-full"  autofocus wire:model.lazy="first_name" />
                    <x-jet-input-error for="first_name" />
                </span>
                <span class="w-1/2">
                    <x-jet-label for="lastName" value="Last name" />
                    <x-jet-input id="lastName" type="text" class="mt-1 block w-full" wire:model.lazy="last_name" />
                    <x-jet-input-error for="last_name" />
                </span>
            </div>

            <div class="mt-4">
                <x-jet-label for="address" value="Address" />
                <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.lazy="address" />
                <x-jet-input-error for="address" />
            </div>

            <div class="mt-4">
                <x-jet-label for="contact_number" value="Contact Number" />
                <x-jet-input id="contact_number" type="text" class="mt-1 block w-full" wire:model.lazy="contact_number" />
                <x-jet-input-error for="contact_number" />
            </div>

            <div class="mt-4">
                <x-jet-label for="username" value="Username" />
                <x-jet-input id="username" type="text" class="mt-1 block w-full" wire:model.lazy="username" />
                <x-jet-input-error for="username" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="Email" />
                <x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model.lazy="email" />
                <x-jet-input-error for="email" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="Password" />
                <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.lazy="password" />
                <x-jet-input-error for="password" />
            </div>
            
            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="Confirm Password" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" wire:model.lazy="password_confirmation"/>
                <x-jet-input-error for="password_confirmation" />
            </div>

            {{-- <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="username" value="{{ __('Username') }}" />
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div> --}}
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
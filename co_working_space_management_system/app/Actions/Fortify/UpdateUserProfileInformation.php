<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{

    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        if ($user->roles == 2) {
            Validator::make($input, [
                'username' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'photo' => ['nullable', 'image', 'max:1024'],
                'customer.first_name' => ['required', 'string', 'max:255'],
                'customer.last_name' => ['required', 'string', 'max:255'],
                'customer.address' => ['required', 'string', 'max:255'],
                'customer.contact_number' => ['required', 'regex:/^(01)[0-46-9]*[0-9]{7,8}$/', Rule::unique('customers', 'contact_number')->ignore($user->customer->id)]
            ], $this->messages)->validateWithBag('updateProfileInformation');
        } else {
            Validator::make($input, [
                'username' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'photo' => ['nullable', 'image', 'max:1024'],
                'employee.first_name' => ['required', 'string', 'max:255'],
                'employee.last_name' => ['required', 'string', 'max:255'],
                'employee.address' => ['required', 'string', 'max:255'],
                'employee.contact_number' => ['required', 'regex:/^(01)[0-46-9]*[0-9]{7,8}$/', Rule::unique('employees', 'contact_number')->ignore($user->employee->id)]
            ], $this->messages)->validateWithBag('updateProfileInformationemployee');
        }




        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'username' => $input['username'],
                'email' => $input['email'],
            ])->save();
            if ($user->roles == 2) {
                $user->customer->update([
                    'first_name' => $input['customer']['first_name'],
                    'last_name' => $input['customer']['last_name'],
                    'address' => $input['customer']['address'],
                    'contact_number' => $input['customer']['contact_number']
                ]);
            } else {
                $user->employee->update([
                    'first_name' => $input['employee']['first_name'],
                    'last_name' => $input['employee']['last_name'],
                    'address' => $input['employee']['address'],
                    'contact_number' => $input['employee']['contact_number']
                ]);
            }
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'username' => $input['username'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    /**
     * Custom validation messages
     *
     * @var array
     */
    protected $messages = [
        'customer.first_name.required' => "First name is required",
        'customer.last_name.required' => "Last name is required",
        'customer.address.required' => 'Address is required',
        'customer.contact_number.required' => 'Contact number is required',

        'customer.first_name.string' => "First name has to be a string",
        'customer.last_name.string' => "Last name has to be a string",
        'customer.address.string' => 'Address has to be a string',
        'customer.contact_number.regex' => 'Contact number must follow the format of 011-12345678',

        'customer.first_name.max' => 'Maximum of 255 words only',
        'customer.last_name.max' => 'Maximum of 255 words only',
        'customer.address.max' => 'Maximum of 255 words only',

        'employee.first_name.required' => "First name is required",
        'employee.last_name.required' => "Last name is required",
        'employee.address.required' => 'Address is required',
        'employee.contact_number.required' => 'Contact number is required',

        'employee.first_name.string' => "First name has to be a string",
        'employee.last_name.string' => "Last name has to be a string",
        'employee.address.string' => 'Address has to be a string',
        'employee.contact_number.regex' => 'Contact number must follow the format of 011-12345678',

        'employee.first_name.max' => 'Maximum of 255 words only',
        'employee.last_name.max' => 'Maximum of 255 words only',
        'employee.address.max' => 'Maximum of 255 words only',

    ];
}

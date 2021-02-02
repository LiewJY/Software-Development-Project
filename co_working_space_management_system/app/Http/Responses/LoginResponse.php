<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $role = Auth::user()->roles;

        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        }

        switch ($role) {
            case 0:
                return redirect()->intended(config('fortify.admin')); //admin dashboard
            case 1:
                return redirect()->intended(config('fortify.employee')); //employee dashboard
            default:
                return redirect()->intended(config('fortify.home')); //customer dashboard
        }
    }
}

<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    /**
     * If user role is different than 'client', user will be
     * redirected to the intranet.
     */
    public function toResponse($request)
    {
        if (auth()->user()->getRole->name != "client") {
            return $request->wantsJson()
                ? response()->json(['two_factor' => false])
                : redirect('intranet');
        }

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended(config('fortify.home'));
    }
}

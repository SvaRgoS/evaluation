<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Auth\SignInRequest;
use App\Http\Resources\ProfileDetailResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SignInController
{
    /**
     * Handle an authentication attempt.
     *
     * @param SignInRequest $request
     * @return RedirectResponse
     */
    public function signIn(SignInRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response(
                new ProfileDetailResource(Auth::getUser()),
                Response::HTTP_OK
            );
        }

        return back(Response::HTTP_BAD_GATEWAY)->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}

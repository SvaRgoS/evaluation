<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Auth\SignUpRequest;
use App\Http\Resources\ProfileDetailResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SignUpController
{
    /**
     * Handle an authentication attempt.
     *
     * @param SignUpRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signUp(SignUpRequest $request)
    {
        $userData = $request->validated();

        if (User::create($userData)) {
            return response(
                new ProfileDetailResource(Auth::getUser()),
                Response::HTTP_OK);
        }

        return back(Response::HTTP_BAD_REQUEST)->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\ProfileRequest;
use App\Http\Requests\Auth\SignInRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Http\Resources\ProfileDetailResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;


class AuthController extends BaseApiController
{

    /**
     * Handle an authentication attempt.
     *
     * @param SignInRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function signIn(SignInRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }
        return $this->createNewToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function createNewToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => new ProfileDetailResource(auth()->user())
        ]);
    }

    /**
     * Handle an authentication attempt.
     *
     * @param SignUpRequest $request
     * @return RedirectResponse
     */
    public function signUp(SignUpRequest $request)
    {
        $userData = $request->validated();

        if (User::create($userData)) {
            return response()->json([
                'message' => 'User successfully registered',
            ], Response::HTTP_CREATED);
        }

        return back(Response::HTTP_BAD_REQUEST)->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    /**
     * @param ProfileRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(ProfileRequest $request, User $user)
    {
        $user->fill($request->except(['id']));
        $user->save();
        return $this->refresh();
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function signOut()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

}

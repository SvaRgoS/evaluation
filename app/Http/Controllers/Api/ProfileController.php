<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\ProfileRequest;
use App\Http\Resources\ProfileDetailResource;
use App\Models\User;

class ProfileController extends BaseApiController
{
    /**
     * @param ProfileRequest $request
     * @param User $profile
     * @return ProfileDetailResource
     */
    public function update(ProfileRequest $request, User $profile): ProfileDetailResource
    {
        $profile->fill($request->except(['id']));
        $profile->save();
        return new ProfileDetailResource($profile);
    }
}

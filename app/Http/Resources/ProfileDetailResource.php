<?php

namespace App\Http\Resources;

use App\Models\Contact;
use App\Models\RoleToPermission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileDetailResource extends JsonResource
{
    public function toArray($request)
    {
        $result =  parent::toArray($request);

        unset($result['email_verified_at']);
        unset($result['updated_at']);
        unset($result['created_at']);

        $result['id'] = $this->id;
        $result['permissions'] = $this->permissions->toArray();

        $result['role'] = (new RoleResource($this->role))->toArray(null);
        return $result;
    }
}


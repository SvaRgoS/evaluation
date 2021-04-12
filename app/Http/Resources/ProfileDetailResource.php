<?php

namespace App\Http\Resources;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileDetailResource extends JsonResource
{
    public function toArray($request)
    {
        $result =  parent::toArray($request);
        $result['id'] = $this->id;
        $result['permissions'] = $this->permissions;
        return $result;
    }
}


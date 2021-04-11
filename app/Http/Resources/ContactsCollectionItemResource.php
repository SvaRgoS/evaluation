<?php

namespace App\Http\Resources;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactsCollectionItemResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {

        /**
         * @var $this Contact
         */
        return [
            'id' => $this->id,
            'name' => $this->first_name . ' ' . $this->last_name,
            'description' => $this->description,
            'phone' => $this->phone
        ];
    }
}

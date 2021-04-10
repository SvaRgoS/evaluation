<?php

namespace App\Http\Resources;


class ContactsCollectionResource extends BaseJsonCollectionResource
{
    public $collects = ContactsCollectionItemResource::class;
}

<?php

namespace App\Http\Controllers\Api;

use App\Contracts\UsersPermissions;
use App\Http\Resources\ContactsCollectionResource;
use App\Http\Resources\ContactsDetailResource;
use App\Models\Contact;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContactController extends BaseApiController
{
    use AuthorizesRequests;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return ContactsCollectionResource
     */
    public function index(): ContactsCollectionResource
    {
        $this->authorize(UsersPermissions::READ, Contact::class);

        $contacts = Contact::all();
        return new ContactsCollectionResource($contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ContactsDetailResource
     */
    public function store(Request $request): ContactsDetailResource
    {
        $this->authorize(UsersPermissions::WRITE, Contact::class);

        $contact = Contact::create($request->all());
        return new ContactsDetailResource($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param Contact $contact
     * @return ContactsDetailResource
     */
    public function show(Contact $contact): ContactsDetailResource
    {
        $this->authorize(UsersPermissions::READ, Contact::class);

        return new ContactsDetailResource($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Contact $contact
     * @return ContactsDetailResource
     */
    public function update(Request $request, Contact $contact): ContactsDetailResource
    {
        $this->authorize(UsersPermissions::WRITE, Contact::class);

        $contact->fill($request->except(['id']));
        $contact->save();

        return new ContactsDetailResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contact $contact
     * @return Application|ResponseFactory|Response
     * @throws \Exception
     */
    public function destroy(Contact $contact)
    {
        $this->authorize(UsersPermissions::REMOVE, Contact::class);

        return response(null, $contact->delete() ? 204 : 500);
    }
}

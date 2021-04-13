<?php

namespace Tests\Unit;

use App\Http\Resources\ContactsCollectionItemResource;
use App\Http\Resources\ContactsDetailResource;
use App\Http\Resources\ProfileDetailResource;
use App\Models\Contact;
use App\Models\User;
use Tests\TestCase;

class ResourcesTest extends TestCase
{
    /** @test */
    public function contactsCollectionItemResourceIsCorrect()
    {
        // Arrange
        $contact = Contact::factory()->create();
        $expectedResult = [
            "id" => $contact->id,
            "name" => $contact->first_name . ' ' . $contact->last_name,
            "description" => $contact->description,
            "phone" => $contact->phone
        ];

        // Act
        $realResult = (new ContactsCollectionItemResource($contact))->toArray(null);

        // Assert
        $this->assertEquals($expectedResult, $realResult);
    }

    /** @test */
    public function contactsDetailResourceIsCorrect()
    {
        // Arrange
        /** @var Contact $contact */
        $contact = Contact::factory()->create();
        $expectedResult = [
            "id" => $contact->id,
            "first_name" => $contact->first_name,
            "last_name" => $contact->last_name,
            "description" => $contact->description,
            "phone" => $contact->phone,
            "email" => $contact->email,
            "country" => $contact->country,
            "city" => $contact->city,
            "address_line_1" => $contact->address_line_1,
            "address_line_2" => $contact->address_line_2,
        ];

        // Act
        $realResult = (new ContactsDetailResource($contact))->toArray(null);


        // Assert
        $this->assertEquals($expectedResult, $realResult);
    }

    /** @test */
    public function profileDetailResourceIsCorrect()
    {
        // Arrange
        /** @var User $user */
        $user = User::factory()->create();

        $expectedResult = [
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "role_id" => $user->role_id,
            "permissions" => $user->permissions->toArray(),
            "role" => [
                "id" => $user->role->id,
                "name" => $user->role->name
            ]
        ];

        // Act
        $realResult = (new ProfileDetailResource($user))->toArray(null);


        // Assert
        $this->assertEquals($expectedResult, $realResult);
    }
}

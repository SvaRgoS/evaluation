<?php

namespace Tests\Feature\Contacts;


use Tests\CrudTestCase;

class WriterCrudTest extends CrudTestCase
{
    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->setBaseRoute('contact');
        $this->setBaseModel('App\Models\Contact');
    }

    /** @test */
    public function a_writer_can_create_a_contact()
    {
        $this->signInAsWriter()->createSuccessful();
    }


    /** @test */
    public function a_writer_can_update_a_contact()
    {
        $this->signInAsWriter()->updateSuccessful();
    }

    /** @test */
    public function a_writer_cannot_remove_a_contact()
    {
        $this->signInAsWriter()->removeForbidden();
    }
}

<?php

namespace Tests\Unit;

use App\Models\ClientContact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientContactsTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_client_contact()
    {
        $clientContact = ClientContact::factory()->create();

        $this->assertInstanceOf(ClientContact::class, $clientContact);
    }

    public function test_can_retrieve_client_contact_data()
    {
        $clientContact = ClientContact::factory()->create();

        $retrievedContact = ClientContact::find($clientContact->id);

        $this->assertEquals($clientContact->name, $retrievedContact->name);
        // Add more assertions as needed
    }

    // Add more test methods to cover other aspects of your model
}

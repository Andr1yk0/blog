<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\ContactRequest;
use App\Models\User;
use Tests\AuthUser;
use Tests\RefreshDatabaseCustom;
use Tests\TestCase;

class ContactRequestAdminControllerTest extends TestCase
{
    use RefreshDatabaseCustom, AuthUser;

    public function test_contact_request_list(): void
    {
        $contactRequest = ContactRequest::factory()->create();

        $response = $this->setUser()->get('/admin/contact-requests');

        $response->assertStatus(200);
        $response->assertSee($contactRequest->email);
    }

    public function test_delete_contact_request():void
    {
        $contactRequest = ContactRequest::factory()->create();

        $response = $this->setUser()->delete("/admin/contact-requests/$contactRequest->id");

        $response->assertRedirect('/admin/contact-requests');
        $this->assertDatabaseMissing('contact_requests', ['id' => $contactRequest->id]);
    }
}

<?php

use App\Models\ContactRequest;

uses(\Tests\AuthUser::class);
uses(\Tests\RefreshDatabaseCustom::class);

test('contact request list', function () {
    $contactRequest = ContactRequest::factory()->create();

    $response = $this->setUser()->get('/admin/contact-requests');

    $response->assertStatus(200);
    $response->assertSee($contactRequest->email);
});

test('delete contact request', function () {
    $contactRequest = ContactRequest::factory()->create();

    $response = $this->setUser()->delete("/admin/contact-requests/$contactRequest->id");

    $response->assertRedirect('/admin/contact-requests');
    $this->assertDatabaseMissing('contact_requests', ['id' => $contactRequest->id]);
});
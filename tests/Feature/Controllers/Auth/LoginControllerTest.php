<?php
use Tests\AuthUser;
use Tests\RefreshDatabaseCustom;

uses(AuthUser::class);
uses(RefreshDatabaseCustom::class);

describe('login', function (){
    test('redirects to home if logged in', function () {
        $response = $this->setUser()->get('/login');
        $response->assertRedirect('/admin');
    });
});
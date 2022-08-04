<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('test if route is available', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

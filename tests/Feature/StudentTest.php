<?php

use App\Models\User;

test('test if user is authenticated ', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/');

    $response->assertStatus(200);
});

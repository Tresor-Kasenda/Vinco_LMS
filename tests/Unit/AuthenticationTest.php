<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('does not authenticate', function (){
    $user = User::factory()->create();

    actingAs($user)->get('/profile')->assertSee($user->name);
});

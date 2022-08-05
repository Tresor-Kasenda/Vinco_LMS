<?php

use App\Models\User;

test('asserts true is true', function () {
    User::factory()->create();
    $this->assertTrue(true);

    expect(true)->toBeTrue();
});

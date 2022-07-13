<?php


use function Pest\Laravel\get;

test('asserts true is true', function () {
    $this->assertTrue(true);

    expect(true)->toBeTrue();
});

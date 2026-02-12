<?php

declare(strict_types=1);

test('application returns response from the home endpoint', function (): void {
    $response = $this->getJson('/');

    $response->assertStatus(200);
    $response->assertExactJson([
        'status' => 'ok',
    ]);
});

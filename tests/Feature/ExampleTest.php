<?php

declare(strict_types=1);

test('application returns a healthcheck response', function (): void {
    $response = $this->getJson('/');

    $response->assertStatus(200);
    $response->assertExactJson([
        'status' => 'ok',
    ]);
});

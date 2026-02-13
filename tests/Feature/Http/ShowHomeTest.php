<?php

declare(strict_types=1);

test('has home', function (): void {
    $response = $this->getJson('/');

    $response->assertStatus(200);
    $response->assertExactJson([
        'status' => 'ok',
    ]);
});

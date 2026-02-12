<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;

test('jsonplaceholder api returns expected post payload shape', function (): void {
    $response = Http::timeout(10)
        ->acceptJson()
        ->get('https://jsonplaceholder.typicode.com/posts/1');

    $response->throw();

    $post = $response->json();

    expect($post)->toBeArray();
    expect($post)->toHaveKeys(['userId', 'id', 'title', 'body']);
    expect($post['id'])->toBe(1);
});

<?php

namespace Dystcz\LunarNewsletter\Tests\Feature;

use Dystcz\LunarNewsletter\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Faker\fake;

uses(TestCase::class, RefreshDatabase::class);

it('user can subscribe to newsletter', function () {
    $data = [
        'type' => 'newsletters',
        'attributes' => [
            'email' => fake()->email(),
        ],
    ];

    $response = $this
        ->jsonApi()
        ->expects('newsletters')
        ->withData($data)
        ->post('/api/v1/newsletters/-actions/subscribe');

    $response->assertSuccessful();
});

it('requires emails in order to sign up', function () {
    $data = [
        'type' => 'newsletters',
        'attributes' => [
            'email' => '',
        ],
    ];

    $response = $this
        ->jsonApi()
        ->expects('newsletters')
        ->withData($data)
        ->post('/api/v1/newsletters/-actions/subscribe');

    $expected = [
        'source' => ['pointer' => '/data/attributes/email'],
        'status' => '422',
        'detail' => 'Please enter an email address',
    ];

    $response->assertError(422, $expected);
});

it('doesnt accept invalid emails', function () {
    $data = [
        'type' => 'newsletters',
        'attributes' => [
            'email' => 'ahoj',
        ],
    ];

    $response = $this
        ->jsonApi()
        ->expects('newsletters')
        ->withData($data)
        ->post('/api/v1/newsletters/-actions/subscribe');

    $expected = [
        'source' => ['pointer' => '/data/attributes/email'],
        'status' => '422',
        'detail' => 'Please enter a valid email address',
    ];

    $response->assertError(422, $expected);
});

<?php

declare(strict_types=1);

use App\Models\User;

it('loads fine without a user', function (): void {
    $content = $this->get('/')
        ->assertOk();

    expect($content->content())
        ->toMatchSnapshot();
});

it('loads fine with a user', function (): void {
    $this->actingAs($user = User::factory()->create()->fresh());

    $content = $this->get('/')
        ->assertOk();

    expect($content->content())
        ->toMatchSnapshot();
});

it('loads the app layout fine without a user', function (): void {
    $this->view('layouts.app', ['slot' => 'test page content'])
        ->assertSee(config('app.name'));
});

it('loads the app layout fine with a user', function (): void {
    $this->actingAs($user = User::factory()->create()->fresh());

    $this->get('/dashboard')
        ->assertSee(config('app.name'))
        ->assertSee($user->name);
});

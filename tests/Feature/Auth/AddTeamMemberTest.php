<?php

declare(strict_types=1);

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

test('team members can be added to teams', function (): void {
    Mail::fake();

    $user = User::factory()->create()->fresh();
    $this->actingAs($user);

    $team = app(CreateTeam::class)->create($user, ['name' => 'test team']);

    $otherUser = User::factory()->create()->fresh();

    AddTeamMember::run(
        $user,
        $team,
        $otherUser->email,
        'editor'
    );

    $team->refresh();
    $team->load('users');

    expect($team->owner->id)->toBe($user->id)
        ->and($team->users->pluck('id'))->toContain($otherUser->id);
});

test('only team owner can add team members', function (): void {
    $user = User::factory()->create()->fresh();
    $otherUser = User::factory()->create()->fresh();

    $team = app(CreateTeam::class)->create($user, ['name' => 'test team']);

    $this->actingAs($otherUser);

    AddTeamMember::shouldRun()
        ->with($user, $team, 'new_team_member@example.com', 'user')
        ->andThrow(AuthorizationException::class);

    $team->refresh();

    expect($team->users)->toHaveCount(0);
});

<?php

declare(strict_types=1);

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

beforeEach(function (): void {
    $this->user = User::factory()->create()->fresh();
});

it('updates basic information properly', function (): void {
    $updateUserProfileInformation = app(UpdateUserProfileInformation::class);

    $updateUserProfileInformation->update($this->user, [
        'name' => 'new name',
        'email' => $this->user->email,
        'photo' => null,
    ]);

    $this->user->refresh();

    expect($this->user->name)->toBe('new name');
});

it('updates the profile photo', function (): void {
    $updateUserProfileInformation = app(UpdateUserProfileInformation::class);

    Storage::fake('public');

    $file = UploadedFile::fake()->image('new-avatar.jpg');

    $updateUserProfileInformation->update($this->user, [
        'name' => 'new name',
        'email' => $this->user->email,
        'photo' => $file,
    ]);

    $this->user->refresh();

    expect($this->user->name)->toBe('new name')
        ->and($this->user->profile_photo_path)->not()->toBeNull();

    Storage::disk('public')->assertExists($this->user->profile_photo_path);
});

it('will update user email if we do not require verification', function (): void {
    $updateUserProfileInformation = app(UpdateUserProfileInformation::class);

    $updateUserProfileInformation->update($this->user, [
        'name' => 'new name',
        'email' => 'new_email@test.com',
        'photo' => null,
    ]);

    $this->user->refresh();

    expect($this->user->email_verified_at)->not()->toBeNull()
        ->and($this->user->email)->toBe('new_email@test.com');
})
    ->skip(fn (): bool => $this->user instanceof MustVerifyEmail);

it('will reset the verification status of a user when their email is changed', function (): void {
    Notification::fake();

    $updateUserProfileInformation = app(UpdateUserProfileInformation::class);

    $updateUserProfileInformation->update($this->user, [
        'name' => 'new name',
        'email' => 'new_email@test.com',
        'photo' => null,
    ]);

    $this->user->refresh();

    expect($this->user->email_verified_at)->toBeNull()
        ->and($this->user->email)->toBe('new_email@test.com');

    Notification::assertSentTo([$this->user], VerifyEmail::class);
})
    ->skip(fn (): bool => ! $this->user instanceof MustVerifyEmail);

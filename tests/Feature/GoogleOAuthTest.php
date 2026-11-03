<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as GoogleUser;
use Spatie\Permission\Models\Role;

test('login screen provides Google sign in', function () {
    $this->get(route('login'))
        ->assertSuccessful()
        ->assertSee('Sign in to Eduleb')
        ->assertSee('name="email"', false)
        ->assertSee('Continue with Google')
        ->assertSee(route('auth.google'));
});

test('registration screen presents the account creation form', function () {
    $this->get(route('register'))
        ->assertSuccessful()
        ->assertSee('Create your account')
        ->assertSee('name="name"', false)
        ->assertSee('name="email"', false)
        ->assertSee('name="password_confirmation"', false)
        ->assertSee(route('register'))
        ->assertSee(route('login'));
});

test('users can be redirected to Google', function () {
    Socialite::fake('google');

    $this->get(route('auth.google'))
        ->assertRedirect('https://socialite.fake/google/authorize');
});

test('verified Google users can sign in and new accounts receive the student role', function () {
    Role::findOrCreate('student', 'web');
    Socialite::fake('google', GoogleUser::fake([
        'id' => 'google-user-123',
        'name' => 'Google Learner',
        'email' => 'learner@example.com',
        'avatar' => 'https://example.com/avatar.jpg',
        'email_verified' => true,
    ]));

    $this->get(route('auth.google.callback'))
        ->assertRedirect('/');

    $this->assertAuthenticated();
    $user = User::where('email', 'learner@example.com')->firstOrFail();

    expect($user->google_id)->toBe('google-user-123')
        ->and($user->name)->toBe('Google Learner')
        ->and($user->image)->toBe('https://example.com/avatar.jpg')
        ->and($user->email_verified_at)->not->toBeNull()
        ->and($user->hasRole('student'))->toBeTrue()
        ->and(Hash::needsRehash($user->password))->toBeFalse();
});

test('existing users are linked while retaining their password and profile image', function () {
    $user = User::factory()->create([
        'email' => 'existing@example.com',
        'password' => Hash::make('existing-password'),
    ]);
    $existingImage = $user->image;

    Socialite::fake('google', GoogleUser::fake([
        'id' => 'google-user-456',
        'name' => 'Updated Name',
        'email' => 'existing@example.com',
        'avatar' => 'https://example.com/new-avatar.jpg',
        'email_verified' => true,
    ]));

    $this->get(route('auth.google.callback'))
        ->assertRedirect('/');

    expect(User::whereKey($user->id)->firstOrFail())
        ->google_id->toBe('google-user-456')
        ->name->toBe($user->name)
        ->image->toBe($existingImage)
        ->password->toBe($user->password);
});

test('existing users without a profile image receive the Google avatar', function () {
    $user = User::factory()->create([
        'email' => 'no-image@example.com',
        'image' => null,
    ]);

    Socialite::fake('google', GoogleUser::fake([
        'id' => 'google-user-101',
        'email' => 'no-image@example.com',
        'avatar' => 'https://example.com/google-avatar.jpg',
        'email_verified' => true,
    ]));

    $this->get(route('auth.google.callback'))
        ->assertRedirect('/');

    expect(User::whereKey($user->id)->firstOrFail())
        ->google_id->toBe('google-user-101')
        ->image->toBe('https://example.com/google-avatar.jpg');
});

test('unverified Google email addresses are rejected', function () {
    Socialite::fake('google', GoogleUser::fake([
        'id' => 'google-user-789',
        'email' => 'unverified@example.com',
        'email_verified' => false,
    ]));

    $this->get(route('auth.google.callback'))
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors('google');

    $this->assertGuest();
    $this->assertDatabaseMissing('users', ['email' => 'unverified@example.com']);
});

test('Google callback failures return an error to the login screen', function () {
    Socialite::fake('google', fn () => throw new RuntimeException('Google OAuth failed.'));

    $this->get(route('auth.google.callback'))
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors('google');

    $this->assertGuest();
});

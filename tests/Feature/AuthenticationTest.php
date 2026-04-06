<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    // TC-AUTH-01: Successful registration
    public function test_user_can_register_with_valid_data()
    {
        $response = $this->post('/register', [
            'name'                  => 'Test User',
            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/'); // lands on upload page (resume.index)
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    // TC-AUTH-02: Duplicate email is rejected
    public function test_registration_fails_with_duplicate_email()
    {
        User::factory()->create(['email' => 'taken@example.com']);

        $response = $this->post('/register', [
            'name'                  => 'Another User',
            'email'                 => 'taken@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    // TC-AUTH-03: Password shorter than 8 chars is rejected
    public function test_registration_fails_with_short_password()
    {
        $response = $this->post('/register', [
            'name'                  => 'Test User',
            'email'                 => 'test@example.com',
            'password'              => 'abc',
            'password_confirmation' => 'abc',
        ]);

        $response->assertSessionHasErrors(['password']);
        $this->assertGuest();
    }

    // TC-AUTH-04: Correct credentials logs user in and redirects to /
    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email'    => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    // TC-AUTH-05: Wrong password shows generic error
    public function test_login_fails_with_wrong_password()
    {
        $user = User::factory()->create([
            'password' => Hash::make('correctpassword'),
        ]);

        $response = $this->post('/login', [
            'email'    => $user->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    // TC-AUTH-06: Non-existent email shows same generic error (no user enumeration)
    public function test_login_fails_with_nonexistent_email()
    {
        $response = $this->post('/login', [
            'email'    => 'nobody@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    // TC-AUTH-07: Password reset email is sent for known email
    public function test_password_reset_email_is_sent()
    {
        $user = User::factory()->create();

        $response = $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        $response->assertSessionHas('status');
    }

    // TC-AUTH-08: Password can be reset with a valid token
    public function test_user_can_reset_password_with_valid_token()
    {
        $user  = User::factory()->create();
        $token = Password::createToken($user);

        $response = $this->post('/reset-password', [
            'token'                 => $token,
            'email'                 => $user->email,
            'password'              => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect('/login');
        $this->assertTrue(Hash::check('newpassword123', $user->fresh()->password));
    }

    // TC-AUTH-09: Logged-in user can log out
    public function test_user_can_logout()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    // TC-AUTH-10: Guest can access the upload page without logging in
    public function test_guest_can_access_upload_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // TC-AUTH-11: After login user lands on / not /dashboard
    public function test_login_redirects_to_upload_not_dashboard()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email'    => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/');
        // Explicitly confirm it's not going to /dashboard
        $this->assertNotEquals('/dashboard', $response->headers->get('Location'));
    }

    // TC-AUTH-08: History route requires authentication (protected route test)
    public function test_history_redirects_guest_to_login()
    {
        $response = $this->get('/history');
        $response->assertRedirect('/login');
    }
}
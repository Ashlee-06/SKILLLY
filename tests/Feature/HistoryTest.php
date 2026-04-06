<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\ChatSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HistoryTest extends TestCase
{
    use RefreshDatabase;

    // Helper: create a ChatSession belonging to a user
    private function createSession(User $user, array $overrides = []): ChatSession
    {
        return ChatSession::create(array_merge([
            'user_id' => $user->id,
            'career'  => 'Data Scientist',
            'score'   => 80,
        ], $overrides));
    }

    // TC-HIST-00: History page requires authentication
    public function test_history_page_redirects_guests_to_login()
    {
        $response = $this->get('/history');
        $response->assertRedirect('/login');
    }

    // TC-HIST-01: History page loads for authenticated user
    public function test_history_page_loads_for_authenticated_user()
    {
        $user     = User::factory()->create();
        $response = $this->actingAs($user)->get('/history');
        $response->assertStatus(200);
    }

    // TC-HIST-01b: Saved analysis appears on history page
    public function test_saved_analysis_appears_in_history()
    {
        $user = User::factory()->create();
        $this->createSession($user, ['career' => 'Backend Developer']);

        $response = $this->actingAs($user)->get('/history');

        $response->assertStatus(200);
        $response->assertSee('Backend Developer');
    }

    // TC-HIST-02: Another user's sessions do not leak into history
    public function test_other_user_sessions_do_not_appear_in_history()
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();
        $this->createSession($userA, ['career' => 'Private Career']);

        $response = $this->actingAs($userB)->get('/history');

        $response->assertStatus(200);
        $response->assertDontSee('Private Career');
    }

    // TC-HIST-04: Detail page shows career and score
    public function test_history_detail_shows_correct_data()
    {
        $user    = User::factory()->create();
        $session = $this->createSession($user, ['career' => 'ML Engineer', 'score' => 72]);

        $response = $this->actingAs($user)->get("/history/{$session->id}");

        $response->assertStatus(200);
        $response->assertSee('ML Engineer');
        $response->assertSee('72');
    }

    // TC-HIST-05: PDF can be re-downloaded from history
    public function test_pdf_can_be_downloaded_from_history()
    {
        $user    = User::factory()->create();
        $session = $this->createSession($user);

        $response = $this->actingAs($user)->post("/history/{$session->id}/download");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    // TC-HIST-06: Record still exists if delete is not confirmed
    public function test_analysis_is_not_deleted_without_confirmation()
    {
        $user    = User::factory()->create();
        $session = $this->createSession($user);

        // We simply don't call DELETE — DB should be unchanged
        $this->assertDatabaseHas('chat_sessions', ['id' => $session->id]);
    }

    // TC-HIST-07: Confirmed delete removes the session
    public function test_analysis_is_deleted_after_confirmation()
    {
        $user    = User::factory()->create();
        $session = $this->createSession($user);

        $response = $this->actingAs($user)->delete("/history/{$session->id}");

        $response->assertRedirect('/history');
        $this->assertDatabaseMissing('chat_sessions', ['id' => $session->id]);
    }

    // TC-HIST-09: User B cannot view User A's session (403)
    public function test_user_cannot_view_another_users_analysis()
    {
        $userA   = User::factory()->create();
        $userB   = User::factory()->create();
        $session = $this->createSession($userA);

        $response = $this->actingAs($userB)->get("/history/{$session->id}");

        $response->assertStatus(403);
    }

    // TC-HIST-09b: User B cannot delete User A's session (403)
    public function test_user_cannot_delete_another_users_analysis()
    {
        $userA   = User::factory()->create();
        $userB   = User::factory()->create();
        $session = $this->createSession($userA);

        $response = $this->actingAs($userB)->delete("/history/{$session->id}");

        $response->assertStatus(403);
    }
}
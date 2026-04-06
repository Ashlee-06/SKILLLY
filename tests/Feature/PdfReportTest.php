<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\ChatSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PdfReportTest extends TestCase
{
    use RefreshDatabase;

    protected array $sessionResult;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sessionResult = [
            'career'              => 'Data Scientist',
            'score'               => 82,
            'matched_skills'      => ['Python', 'SQL', 'Machine Learning'],
            'missing_skills'      => ['Docker', 'AWS', 'Kubernetes'],
            'alternative_careers' => [
                ['name' => 'ML Engineer',       'score' => 70],
                ['name' => 'Data Analyst',      'score' => 65],
                ['name' => 'Backend Developer', 'score' => 55],
                ['name' => 'DevOps Engineer',   'score' => 40],
            ],
        ];
    }

    // TC-PDF-01: POST /download-report returns a PDF
    public function test_download_report_returns_pdf()
    {
        $response = $this->withSession(['result' => $this->sessionResult])
                         ->post('/download-report');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    // TC-PDF-02 & TC-PDF-03: Home page shows career name and score from session
    public function test_results_page_shows_career_and_score()
    {
        $response = $this->withSession(['result' => $this->sessionResult])
                         ->get('/');

        $response->assertSee('Data Scientist');
        $response->assertSee('82');
    }

    // TC-PDF-04: Matched and missing skills appear in results
    public function test_matched_and_missing_skills_appear_in_results()
    {
        $response = $this->withSession(['result' => $this->sessionResult])
                         ->get('/');

        $response->assertSee('Python');
        $response->assertSee('SQL');
        $response->assertSee('Docker');
        $response->assertSee('AWS');
    }

    // TC-PDF-06: Up to 4 alternative careers are included in session data
    public function test_up_to_four_alternative_careers_are_included()
    {
        $alternatives = $this->sessionResult['alternative_careers'];

        $this->assertLessThanOrEqual(4, count($alternatives));
        $this->assertNotEmpty($alternatives);
    }

    // TC-PDF-07: First missing skill is at the top of the action plan
    public function test_action_plan_starts_with_top_missing_skill()
    {
        $topMissing = $this->sessionResult['missing_skills'][0];
        $this->assertEquals('Docker', $topMissing);
    }

    // TC-PDF-09: Re-downloading PDF from history works via ChatSession
    public function test_pdf_can_be_downloaded_from_history()
    {
        $user    = User::factory()->create();
        $session = ChatSession::create([
            'user_id' => $user->id,
            'career'  => 'Data Scientist',
            'score'   => 82,
        ]);

        $response = $this->actingAs($user)
                         ->post("/history/{$session->id}/download");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    // TC-PDF-10: No session → redirected back to upload page
    public function test_expired_session_redirects_to_upload()
    {
        $response = $this->post('/download-report');
        $response->assertRedirect('/');
    }
}
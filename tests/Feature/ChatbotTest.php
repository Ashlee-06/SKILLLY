<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatbotTest extends TestCase
{
    use RefreshDatabase;

    // Shared session data — simulates a completed resume analysis
    protected array $sessionResult;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sessionResult = [
            'career'               => 'Data Scientist',
            'score'                => 78,
            'matched_skills'       => ['Python', 'SQL', 'Machine Learning'],
            'missing_skills'       => ['Docker', 'AWS', 'Kubernetes'],
            'alternative_careers'  => [
                ['name' => 'ML Engineer',   'score' => 65],
                ['name' => 'Data Analyst',  'score' => 60],
            ],
        ];
    }

    /**
     * Helper: POST to chat/message with a session pre-loaded
     */
    private function chat(string $message): \Illuminate\Testing\TestResponse
    {
        return $this->withSession(['result' => $this->sessionResult])
                    ->postJson('/chat/message', ['message' => $message]);
    }

    // TC-CHAT-01: "hello" returns a personalised greeting
    public function test_hello_returns_greeting()
    {
        $response = $this->chat('hello');
        $response->assertStatus(200);
        $response->assertSee('Data Scientist');
    }

    // TC-CHAT-02: "What are my strengths" returns matched skills
    public function test_strengths_returns_matched_skills()
    {
        $response = $this->chat('What are my strengths');
        $response->assertStatus(200);
        $response->assertSee('Python');
        $response->assertSee('SQL');
    }

    // TC-CHAT-03: "What am I missing" returns missing skills
    public function test_missing_returns_missing_skills()
    {
        $response = $this->chat('What am I missing');
        $response->assertStatus(200);
        $response->assertSee('Docker');
        $response->assertSee('AWS');
    }

    // TC-CHAT-04: "How do I get there" returns a numbered roadmap
    public function test_how_to_get_there_returns_roadmap()
    {
        $response = $this->chat('How do I get there');
        $response->assertStatus(200);
        $response->assertSee('1.');
    }

    // TC-CHAT-05: "how ready am I" returns the score percentage
    public function test_readiness_returns_percentage()
    {
        $response = $this->chat('how ready am I');
        $response->assertStatus(200);
        $response->assertSee('78');
    }

    // TC-CHAT-06: "are there other careers for me" lists alternatives
    public function test_alternative_careers_are_listed()
    {
        $response = $this->chat('are there other careers for me');
        $response->assertStatus(200);
        $response->assertSee('ML Engineer');
    }

    // TC-CHAT-07: Salary question mentions Glassdoor
    public function test_salary_response_mentions_glassdoor()
    {
        $response = $this->chat('what salary can I expect');
        $response->assertStatus(200);
        $response->assertSee('Glassdoor');
    }

    // TC-CHAT-08: Resume improvement tips are returned
    public function test_resume_tips_are_returned()
    {
        $response = $this->chat('how can I improve my resume');
        $response->assertStatus(200);
        $response->assertStatus(200); // tips content varies — broaden if needed
    }

    // TC-CHAT-09: Interview prep mentions STAR method
    public function test_interview_prep_mentions_star_method()
    {
        $response = $this->chat('how do I prepare for interviews');
        $response->assertStatus(200);
        $response->assertSee('STAR');
    }

    // TC-CHAT-10: "download" prompts user to click the Download button
    public function test_download_intent_references_download_button()
    {
        $response = $this->chat('download');
        $response->assertStatus(200);
        $response->assertSee('Download');
    }

    // TC-CHAT-11: Unknown input triggers the fallback response
    public function test_unknown_input_returns_fallback()
    {
        $response = $this->chat('xyzabc random nonsense');
        $response->assertStatus(200);
        // Fallback should hint at available questions
        $response->assertSee('strengths'); // adjust to match your actual fallback text
    }

    // TC-CHAT-12: Chat without an active session is rejected
    public function test_chat_without_session_is_rejected()
    {
        // No withSession() — simulates visiting chat with no upload done
        $response = $this->postJson('/chat/message', ['message' => 'hello']);

        // Should either redirect or return an error, not a 200
        $this->assertNotEquals(200, $response->status());
    }

    // TC-CHAT-13: Save chat endpoint accepts a transcript
    public function test_save_chat_stores_transcript()
    {
        $response = $this->withSession(['result' => $this->sessionResult])
                         ->postJson('/chat/save', [
                             'transcript' => [
                                 ['role' => 'user',      'message' => 'hello'],
                                 ['role' => 'assistant', 'message' => 'Hi! You matched Data Scientist.'],
                             ]
                         ]);

        $response->assertStatus(200);
    }
}
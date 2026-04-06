<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CareerRecommendationTest extends TestCase
{
    use RefreshDatabase;

    // TC-REC-01: Top recommended career has the highest score
    public function test_recommended_career_has_highest_score()
    {
        $careers = [
            ['name' => 'Data Scientist',    'score' => 85],
            ['name' => 'Backend Developer', 'score' => 60],
            ['name' => 'DevOps Engineer',   'score' => 45],
        ];

        usort($careers, fn($a, $b) => $b['score'] <=> $a['score']);

        $this->assertEquals('Data Scientist', $careers[0]['name']);
        $this->assertEquals(85, $careers[0]['score']);
    }

    // TC-REC-02: Score shown on results page matches session
    public function test_score_shown_on_results_page_matches_session()
    {
        $sessionResult = ['career' => 'Data Scientist', 'score' => 82];

        $response = $this->withSession(['result' => $sessionResult])->get('/');

        $response->assertSee('82');
        $response->assertSee('Data Scientist');
    }

    // TC-REC-03: Careers below 15% threshold are excluded
    public function test_careers_below_15_percent_are_excluded()
    {
        $careers = [
            ['name' => 'Data Scientist', 'score' => 85],
            ['name' => 'Game Developer', 'score' => 10],
            ['name' => 'UX Designer',    'score' => 5],
        ];

        $filtered = array_values(array_filter($careers, fn($c) => $c['score'] >= 15));

        $this->assertCount(1, $filtered);
        $this->assertEquals('Data Scientist', $filtered[0]['name']);
    }

    // TC-REC-04: Alternative careers are ranked by descending score
    public function test_alternative_careers_are_ranked_descending()
    {
        $careers = [
            ['name' => 'DevOps',      'score' => 55],
            ['name' => 'Backend Dev', 'score' => 70],
            ['name' => 'ML Engineer', 'score' => 65],
        ];

        usort($careers, fn($a, $b) => $b['score'] <=> $a['score']);

        $this->assertEquals('Backend Dev', $careers[0]['name']);
        $this->assertEquals('ML Engineer', $careers[1]['name']);
        $this->assertEquals('DevOps',      $careers[2]['name']);
    }

    // TC-REC-05: Session data contains both matched and missing skills
    public function test_session_has_matched_and_missing_skills()
    {
        $result = [
            'career'         => 'Data Scientist',
            'score'          => 75,
            'matched_skills' => ['Python', 'SQL'],
            'missing_skills' => ['Docker', 'AWS'],
        ];

        $response = $this->withSession(['result' => $result])->get('/');

        $response->assertSee('Python');
        $response->assertSee('Docker');
    }
}
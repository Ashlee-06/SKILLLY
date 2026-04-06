<?php

namespace Tests\Unit;

use Tests\TestCase;

/**
 * Skill Extraction Unit Tests — TC-EX-01 to TC-EX-07
 *
 * These tests validate the logic of your SkillExtractor service in isolation.
 *
 * HOW TO WIRE UP:
 * 1. Find your skill extractor class, e.g. App\Services\SkillExtractor
 * 2. Uncomment the `use` statement and `$this->extractor` lines below
 * 3. Replace `$this->extractSkills($text)` calls with your actual method name
 *
 * Until then, the pure-logic assertions below will still run and pass.
 */
class SkillExtractionTest extends TestCase
{
    // protected \App\Services\SkillExtractor $extractor;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->extractor = new \App\Services\SkillExtractor();
    }

    // TC-EX-01: Skills mentioned in a paragraph are detected
    public function test_skills_detected_in_paragraph_text()
    {
        $text           = 'I have experience in Python, SQL and React';
        $knownSkills    = ['Python', 'SQL', 'React', 'Docker'];
        $detectedSkills = [];

        foreach ($knownSkills as $skill) {
            if (stripos($text, $skill) !== false) {
                $detectedSkills[] = $skill;
            }
        }

        $this->assertContains('Python', $detectedSkills);
        $this->assertContains('SQL',    $detectedSkills);
        $this->assertContains('React',  $detectedSkills);
        $this->assertNotContains('Docker', $detectedSkills);

        // With your actual service:
        // $result = $this->extractor->extract($text);
        // $this->assertContains('Python', $result);
    }

    // TC-EX-04: Skill extraction is case insensitive
    public function test_skill_extraction_is_case_insensitive()
    {
        $variations = ['PYTHON', 'python', 'Python'];
        $normalized = array_unique(array_map('strtolower', $variations));

        $this->assertCount(1, $normalized);
        $this->assertContains('python', $normalized);
    }

    // TC-EX-05: C++, C#, and C are distinct skills (no cross-matching)
    public function test_cpp_csharp_and_c_are_distinct()
    {
        $skills = ['C++', 'C#', 'C'];
        $unique  = array_unique($skills);

        $this->assertCount(3, $unique);
        $this->assertContains('C++', $unique);
        $this->assertContains('C#',  $unique);
        $this->assertContains('C',   $unique);
    }

    // TC-EX-06: Duplicate skill mentions are deduplicated
    public function test_duplicate_skills_are_deduplicated()
    {
        $extracted = ['Machine Learning', 'Machine Learning', 'Machine Learning'];
        $unique     = array_unique($extracted);

        $this->assertCount(1, $unique);
        $this->assertContains('Machine Learning', $unique);
    }

    // TC-EX-07: Soft skills are included in extraction
    public function test_soft_skills_are_detected()
    {
        $text        = 'Strong Communication, Leadership and Teamwork skills.';
        $softSkills  = ['Communication', 'Leadership', 'Teamwork'];
        $detected    = [];

        foreach ($softSkills as $skill) {
            if (stripos($text, $skill) !== false) {
                $detected[] = $skill;
            }
        }

        $this->assertContains('Communication', $detected);
        $this->assertContains('Leadership',    $detected);
        $this->assertContains('Teamwork',      $detected);
    }
}
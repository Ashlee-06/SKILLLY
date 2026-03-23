<?php

namespace App\Services\Career;

use App\Models\CareerDomain;

class CareerRecommendationService
{
    public function recommend(array $extractedSkills): array
    {
        $recommendations = [];

        $extractedSkillNames = collect($extractedSkills)
            ->pluck('name')
            ->map(fn($n) => strtolower(trim($n)))
            ->toArray();

        $careers = CareerDomain::with('rules.skill')->get();

        foreach ($careers as $career) {

            $rules         = $career->rules;
            $totalScore    = 0;
            $matchedScore  = 0;
            $matchedSkills = [];
            $missingSkills = [];

            foreach ($rules as $rule) {
                $skillName  = strtolower(trim($rule->skill->skill_name ?? ''));
                $weight     = (int) ($rule->weight ?? 1);
                $totalScore += $weight;

                if (in_array($skillName, $extractedSkillNames)) {
                    $matchedScore    += $weight;
                    $matchedSkills[]  = $skillName;
                } else {
                    $missingSkills[] = $skillName;
                }
            }

            $matchPercentage = $totalScore > 0
                ? ($matchedScore / $totalScore) * 100
                : 0;

            if ($matchPercentage >= 15) {
                $recommendations[] = [
                    'career'         => $career->career_name,
                    'percentage'     => round($matchPercentage, 2),
                    'matched_skills' => $matchedSkills,
                    'missing_skills' => $missingSkills,
                ];
            }
        }

        usort($recommendations, fn($a, $b) => $b['percentage'] <=> $a['percentage']);

        return $recommendations;
    }
}
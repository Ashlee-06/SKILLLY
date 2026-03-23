<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    protected $fillable = [
        'user_id',
        'resume_file_name',
        'career',
        'readiness_score',
        'matched_skills',
        'missing_skills',
        'all_recommendations',
        'conversation',
    ];

    protected $casts = [
        'matched_skills'      => 'array',
        'missing_skills'      => 'array',
        'all_recommendations' => 'array',
        'conversation'        => 'array',
    ];

    // ── Relationships ──────────────────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ── Helpers ────────────────────────────────────────────────────────────────

    /**
     * Human-readable readiness comment for display in history.
     */
    public function readinessLabel(): string
    {
        return match (true) {
            $this->readiness_score >= 80 => 'Excellent',
            $this->readiness_score >= 60 => 'Good',
            $this->readiness_score >= 40 => 'Developing',
            default                      => 'Early Stage',
        };
    }

    /**
     * Tailwind-compatible colour class for the readiness badge.
     */
    public function readinessBadgeClass(): string
    {
        return match (true) {
            $this->readiness_score >= 80 => 'badge-green',
            $this->readiness_score >= 60 => 'badge-blue',
            $this->readiness_score >= 40 => 'badge-amber',
            default                      => 'badge-red',
        };
    }
}
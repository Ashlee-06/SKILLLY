<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Resume metadata
            $table->string('resume_file_name');

            // Top career recommendation
            $table->string('career');
            $table->unsignedTinyInteger('readiness_score')->default(0);

            // Skill data (stored as JSON)
            $table->json('matched_skills');
            $table->json('missing_skills');
            $table->json('all_recommendations');

            // Full bot + user conversation (updated after chat)
            $table->json('conversation');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_sessions');
    }
};
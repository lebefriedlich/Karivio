<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            
            // Personal Information
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('location');
            $table->text('professional_summary')->nullable();
            
            // Social Links
            $table->string('linkedin_url')->nullable();
            $table->string('portfolio_url')->nullable();
            
            // JSON Fields for Complex Data
            $table->json('work_experiences')->nullable(); // Array of experiences
            $table->json('technical_skills')->nullable(); // Array of skills
            $table->json('hard_skills')->nullable();
            $table->json('soft_skills')->nullable();
            $table->json('education')->nullable(); // Array of education
            $table->json('organization_experiences')->nullable(); // Array of organization experiences
            $table->json('assistance_experiences')->nullable(); // Array of assistance experiences
            $table->json('languages')->nullable(); // Array of languages
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};

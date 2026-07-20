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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('owner_role');
            $table->text('owner_bio');
            $table->string('owner_avatar')->nullable();
            $table->string('location');
            $table->text('relocation_notice');
            $table->string('resume_url')->nullable();
            $table->string('email');
            $table->string('linkedin_url')->nullable();
            $table->string('github_url')->nullable();
            $table->text('ai_assistant_welcome');
            $table->text('meta_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};

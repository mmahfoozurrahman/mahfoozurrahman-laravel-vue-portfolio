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
        Schema::create('github_repos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('repo_id')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('stars_count')->default(0);
            $table->integer('forks_count')->default(0);
            $table->string('language')->nullable();
            $table->string('repo_url');
            $table->timestamp('pushed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('github_repos');
    }
};

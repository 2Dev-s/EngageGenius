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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('tags')->nullable();
            $table->dateTime("publish_date")->default(now());
            $table->string('thumbnail_path')->nullable();
            $table->boolean('post_to_twitter')->default(false);
            $table->boolean('post_to_pinterest')->default(false);
            $table->boolean('post_to_linkedin')->default(false);
            $table->boolean('post_to_instagram')->default(false);
            $table->boolean('post_to_facebook')->default(false);

            $table->boolean('api_tags')->default(false);

            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->foreignId('campain_id')->nullable();

            $table->boolean('published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

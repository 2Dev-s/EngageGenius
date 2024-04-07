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
            $table->text('content');
            $table->text('tags')->nullable();
            $table->dateTime("publish_date")->default(now());

            $table->boolean('twitter')->default(false);
            $table->boolean('pinterest')->default(false);
            $table->boolean('linkedin')->default(false);
            $table->boolean('instagram')->default(false);
            $table->boolean('facebook')->default(false);

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

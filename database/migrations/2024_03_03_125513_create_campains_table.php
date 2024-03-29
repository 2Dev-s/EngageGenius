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
        Schema::create('campains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->string("title")->nullable()->default(null);
            $table->text("description")->nullable()->default(null);
            $table->integer("posts_count")->default(0);
            $table->text("niche")->nullable()->default(null);
            $table->foreignId("tamplate_id")->nullable()->default(null);
            $table->text("product_description");
            $table->text("product_features");
            $table->text("image_data")->nullable();
            $table->integer("discount")->nullable()->default(null);
            $table->string("cta_text")->nullable()->default(null);
            $table->string("redirect_link")->nullable()->default(null);
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->boolean("ended")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campains');
    }
};

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
            $table->string("title");
            $table->text("description");
            $table->text("niche");
            $table->foreignId("tamplate_id");
            $table->text("product_description");
            $table->text("product_features");
            $table->text("image_data")->nullable();
            $table->integer("discount");
            $table->string("cta_text");
            $table->string("redirect_link");
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

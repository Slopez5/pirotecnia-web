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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('experience_level_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->double('price');
            $table->string('duration')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();
            

            $table->foreign('experience_level_id')->references('id')->on('experience_levels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};

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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('client_address')->nullable();
            $table->string('client_city')->nullable();
            $table->string('client_state')->nullable();
            $table->string('client_zip')->nullable();
            $table->string('client_country')->nullable();
            $table->string('client_rfc')->nullable();
            $table->unsignedBigInteger('client_type_id');

            $table->timestamps();

            $table->foreign('client_type_id')->references('id')->on('client_types')->cascadeOnDelete();
            $table->foreign('client_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

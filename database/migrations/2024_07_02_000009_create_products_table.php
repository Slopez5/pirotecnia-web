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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_role_id');
            $table->string('name');
            $table->string('description');
            $table->string('unit');
            $table->string('duration')->nullable();
            $table->string('shots')->nullable();
            $table->string('caliber')->nullable();
            $table->string('shape')->nullable();
            $table->timestamps();

            $table->foreign('product_role_id')->references('id')->on('product_roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

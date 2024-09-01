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
        Schema::create('equipment_package', function (Blueprint $table) {
            $table->unsignedBigInteger('equipment_id');
            $table->unsignedBigInteger('package_id');
            $table->unsignedInteger('quantity');
            $table->timestamps();

            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_package');
    }
};

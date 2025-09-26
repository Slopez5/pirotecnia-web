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
        Schema::table('equipment_event', function (Blueprint $table) {
            //
            $table->boolean('check_employee')->default(false);
            $table->boolean('check_almacen')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipment_event', function (Blueprint $table) {
            //
        });
    }
};

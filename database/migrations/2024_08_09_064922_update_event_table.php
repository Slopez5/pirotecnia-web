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
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('event_type_id')->nullable();
            // delete event_type column
            $table->dropColumn('event_type');
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('advance', 10, 2)->default(0);
            $table->decimal('travel_expenses', 10, 2)->default(0);
            $table->text('notes')->nullable();
            

            $table->foreign('event_type_id')->references('id')->on('event_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
};

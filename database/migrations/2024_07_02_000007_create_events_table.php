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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_type_id')->nullable();
            $table->unsignedBigInteger('package_id');
            $table->date('date');
            $table->string('phone');
            $table->string('client_name');
            $table->string('client_address')->nullable();
            $table->string('event_address');
            $table->timestamp('event_date');
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('advance', 10, 2)->nullable();
            $table->decimal('travel_expenses', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            
            

            $table->foreign('event_type_id')->references('id')->on('event_types')->onDelete('set null');
            $table->foreign('package_id')->references('id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

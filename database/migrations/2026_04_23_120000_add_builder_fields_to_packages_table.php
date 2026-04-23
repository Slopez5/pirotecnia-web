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
        Schema::table('packages', function (Blueprint $table) {
            $table->unsignedBigInteger('event_type_id')->nullable()->after('experience_level_id');
            $table->string('status')->default('draft')->after('video_url');
            $table->date('valid_from')->nullable()->after('status');
            $table->date('valid_until')->nullable()->after('valid_from');

            $table->foreign('event_type_id')->references('id')->on('event_types')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropForeign(['event_type_id']);
            $table->dropColumn(['event_type_id', 'status', 'valid_from', 'valid_until']);
        });
    }
};

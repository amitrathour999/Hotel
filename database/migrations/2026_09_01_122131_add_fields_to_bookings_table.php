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
        // Schema::table('bookings', function (Blueprint $table) {
        //     $table->string('name')->after('room_id');
        //     $table->string('email')->after('name');
        //     $table->string('mobile')->after('email');
        //     $table->integer('guests')->after('mobile');
        //     $table->text('special_requests')->nullable()->after('guests');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('bookings', function (Blueprint $table) {
        //     $table->dropColumn(['name', 'email', 'mobile', 'guests', 'special_requests']);
        // });
    }
};

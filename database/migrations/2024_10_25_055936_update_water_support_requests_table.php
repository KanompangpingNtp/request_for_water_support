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
        Schema::table('water_support_requests', function (Blueprint $table) {
            //
            $table->string('status')->default('1'); // เพิ่มฟิลด์สถานะ
            $table->string('user_name_verifier')->nullable(); // เพิ่มฟิลด์ชื่อผู้ตรวจสอบ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('water_support_requests', function (Blueprint $table) {
            //
            $table->dropColumn(['status', 'user_name_verifier']);
        });
    }
};

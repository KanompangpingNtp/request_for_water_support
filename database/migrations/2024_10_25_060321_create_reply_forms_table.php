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
        Schema::create('reply_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('water_support_requests_id')->constrained('water_support_requests')->onDelete('cascade'); // เชื่อมโยงกับคำร้องน้ำ
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reply_forms');
    }
};

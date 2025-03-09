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
        Schema::create('user_otps', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['email', 'mobile'])->default('mobile');
            $table->string('email')->unique()->nullable();
            $table->string('mobile_prefix')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('code', 20);
            $table->integer('resend')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_otps');
    }
};

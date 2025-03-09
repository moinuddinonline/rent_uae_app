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
        Schema::create('rent_vendors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('rent_type_id');
            $table->string('vendor_name');
            $table->string('email');
            $table->string('mobile');
            $table->string('iban_number');
            $table->timestamps();
            $table->foreign('rent_type_id')->references('id')->on('rent_types')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['rent_type_id', 'user_id', 'iban_number'], 'unique_rent_vendor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_vendors');
    }
};

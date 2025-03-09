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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('rent_vendor_id');
            $table->decimal('amount', 10, 2);
            $table->string('payment_title');
            $table->date('payment_date');
            $table->string('payment_status')->default('pending');
            $table->string('payment_image')->nullable();
            $table->timestamps();
            $table->foreign('rent_vendor_id')->references('id')->on('rent_vendors')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};

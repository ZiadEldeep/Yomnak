<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_cards', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('userId');
            $table->string('cardHolderName');
            $table->string('cardNumber');
            $table->string('cardType'); // مثل "Visa", "MasterCard"
            $table->string('expiryMonth', 2);
            $table->string('expiryYear', 4);
            $table->string('cvv');
            $table->boolean('isDefault')->default(false);
            $table->timestamps();

            // العلاقات مع الجداول الأخرى
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_cards');
    }
};

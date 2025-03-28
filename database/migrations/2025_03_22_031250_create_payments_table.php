<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('userId');
            $table->uuid('orderId');
            $table->string('paymentMethod'); // مثل "credit_card", "paypal", "cash"
            $table->decimal('amount', 10, 2);
            $table->string('currency', 10)->default('USD');
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->text('transactionId')->nullable(); // معرف المعاملة من بوابة الدفع
            $table->timestamps();

            // العلاقات مع الجداول الأخرى
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('orderId')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('userId');
            $table->uuid('carId')->nullable();
            $table->uuid('orderId')->nullable();
            $table->text('content');
            $table->timestamps();

            // العلاقات مع الجداول الأخرى
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('carId')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('orderId')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

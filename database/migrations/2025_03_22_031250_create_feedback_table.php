<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('userId')->nullable();
            $table->uuid('orderId')->nullable();
            $table->integer('rating')->default(1); // 1 to 5 stars
            $table->text('comment')->nullable();
            $table->boolean('isApproved')->default(false);
            $table->timestamps();

            // العلاقات مع الجداول الأخرى
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('orderId')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('order_table', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('partitionId')->nullable();
            $table->string('type')->default('aa');
            $table->uuid('elementId')->nullable();
            $table->string('elementName')->nullable();
            $table->text('elementDescription')->nullable();
            $table->json('priceSizes')->nullable();
            $table->integer('quantity')->default(1);
            $table->uuid('paymentId')->nullable();
            $table->string('imageUrl')->nullable();
            $table->string('buyerName')->nullable();
            $table->string('status')->default('pending');
            $table->timestamp('createdAt')->default(now());
            $table->uuid('userId')->nullable();
            $table->uuid('promoCodeId')->nullable();
            $table->string('size')->nullable();
            $table->string('salad')->nullable();
            $table->json('additions')->nullable();
            $table->float('additionPrice')->nullable();
            $table->uuid('carId')->nullable();
            $table->uuid('customerId')->nullable();
            $table->string('pushToken')->nullable();

            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('carId')->references('id')->on('car')->onDelete('cascade');
            $table->foreign('customerId')->references('id')->on('customer')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_table');
    }
};

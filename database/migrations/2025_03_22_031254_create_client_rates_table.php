<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('client_rate', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('clientId');
            $table->uuid('orderId');
            $table->tinyInteger('rating')->unsigned()->comment('Rating from 1 to 5');
            $table->text('comment')->nullable();
            $table->timestamp('createdAt')->useCurrent();

            $table->foreign('clientId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('orderId')->references('id')->on('order_table')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_rate');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('partitionId');
            $table->string('elementName');
            $table->text('elementDescription')->nullable();
            $table->json('priceSizeOptions')->nullable();
            $table->string('imageUrl')->nullable();
            $table->uuid('userId')->nullable();
            $table->timestamps();

            $table->foreign('partitionId')->references('id')->on('menu_partitions')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('elements');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menu_partitions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('partitionName');
            $table->text('partitionDescription')->nullable();
            $table->uuid('menuId');
            $table->timestamps();
            $table->foreign('menuId')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_partitions');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('promo_code_table', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('partitionId')->nullable();
            $table->string('code')->unique();
            $table->integer('discount')->default(0);
            $table->timestamp('createdAt')->default(now());
            $table->integer('count')->default(0);
            $table->timestamp('endDate')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('promo_code_table');
    }
};

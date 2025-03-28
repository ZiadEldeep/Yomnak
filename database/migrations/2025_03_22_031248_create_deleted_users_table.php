<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deleted_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('userId')->unique();
            $table->string('email')->unique();
            $table->string('name');
            $table->text('reason');
            $table->timestamp('deletedAt')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deleted_users');
    }
};

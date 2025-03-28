<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('timelines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('userId');
            $table->string('startDay');
            $table->string('endDay');
            $table->string('timelineType');
            $table->json('schedule'); // لتخزين جدول زمني بصيغة JSON
            $table->timestamps();

            // العلاقات مع الجداول الأخرى
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timelines');
    }
};

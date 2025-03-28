<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // هذا سيجعل `id` من النوع `BIGINT UNSIGNED`
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('message');
            $table->string('type', 50);
            $table->timestamps();
        });


    }

    public function down()
    {
        Schema::dropIfExists('notification_table');
    }
};

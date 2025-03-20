<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name');
            $table->text('service_description');
            $table->string('service_owner');
            $table->string('service_location');
            $table->float('service_feedback')->default(0);
            $table->string('service_image')->nullable(); // حقل الصورة
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

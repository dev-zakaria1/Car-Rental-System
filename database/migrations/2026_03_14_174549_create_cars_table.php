<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('car_categories')
                ->cascadeOnUpdate();
            $table->foreignId('location_id')
                ->constrained('locations')
                ->cascadeOnUpdate();
            $table->string('make', 100);
            $table->string('model', 100);
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('registration_no', 50)->nullable();
            $table->string('vin', 100)->nullable();
            $table->enum('transmission', ['automatic', 'manual'])->nullable();
            $table->enum('fuel_type', ['petrol', 'diesel', 'hybrid', 'electric', 'others'])->nullable();
            $table->unsignedTinyInteger('doors')->nullable();
            $table->unsignedTinyInteger('seats')->nullable();
            $table->unsignedTinyInteger('luggage')->nullable();
            $table->string('color', 50)->nullable();
            $table->decimal('hour_rate', 10, 2)->default(0);
            $table->string('image_url', 255)->nullable();
            $table->enum('status', ['available', 'unavailable', 'maintenance', 'reserved'])->default('available');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['location_id']);
        });
        Schema::dropIfExists('cars');
    }
};

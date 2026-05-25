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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate();
            $table->foreignId('car_id')
                ->constrained('cars')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('pickup_location_id')
                ->constrained('locations')
                ->cascadeOnUpdate();
            $table->foreignId('dropoff_location_id')
                ->constrained('locations')
                ->cascadeOnUpdate();
            $table->dateTime('pickup_datetime');
            $table->dateTime('dropoff_datetime');
            $table->enum('status', ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->decimal('total_price', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['car_id']);
            $table->dropForeign(['pickup_location_id']);
            $table->dropForeign(['dropoff_location_id']);
        });
        Schema::dropIfExists('bookings');
    }
};

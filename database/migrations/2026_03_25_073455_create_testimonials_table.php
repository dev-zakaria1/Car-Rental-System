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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('user_name', 150);
            $table->string('user_title', 150)->nullable();
            $table->string('avatar_url', 255)->nullable();
            $table->text('content');
            $table->unsignedTinyInteger('rating')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};

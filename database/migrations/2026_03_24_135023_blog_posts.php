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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->foreignId('author_id')
                ->constrained('users')
                ->cascadeOnUpdate();
            $table->dateTime('published_at')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
            $table->unique('slug');
        });
    }
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });
        Schema::dropIfExists('blog_posts');
    }
};

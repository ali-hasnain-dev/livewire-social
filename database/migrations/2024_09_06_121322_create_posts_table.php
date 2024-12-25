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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->boolean('allow_comments')->default(true);
            $table->boolean('allow_likes')->default(true);
            // $table->boolean('is_published')->default(true);
            // $table->boolean('is_featured')->default(false);
            $table->boolean('is_sponsored')->default(false);
            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_reported')->default(false);
            // $table->enum('status', ['draft', 'published', 'scheduled', 'archived'])->default('published');
            // $table->timestamp('published_at')->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->enum('visibility', ['public', 'private', 'only_me'])->default('public');
            $table->enum('type', ['post', 'event', 'job', 'poll'])->default('post');
            $table->foreignId('parent_id')->nullable()->constrained('posts')->cascadeOnDelete();
            // $table->foreignId('group_id')->nullable()->constrained()->cascadeOnDelete();
            // $table->foreignId('page_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

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
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('venue_name');
            $table->string('venue_address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('timezone', 50)->default('Asia/Taipei');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->dateTime('publish_at')->nullable();
            $table->string('organizer')->nullable();
            $table->string('featured_image_url')->nullable();
            $table->string('status', 20)->default('draft');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->foreignUuid('custom_form_id')->nullable()->constrained()->nullOnDelete();
            $table->text('notes')->nullable();
            $table->text('refund_policy')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // 索引
            $table->index(['status', 'start_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

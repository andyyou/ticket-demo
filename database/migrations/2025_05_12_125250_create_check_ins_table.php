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
        Schema::create('check_ins', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('order_item_id')->constrained()->cascadeOnDelete();
            $table->timestamp('checked_in_at');
            $table->string('checked_in_by')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // 索引
            $table->index(['order_item_id']);
            $table->index(['checked_in_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_ins');
    }
}; 
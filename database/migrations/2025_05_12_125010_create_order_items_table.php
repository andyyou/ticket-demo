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
        Schema::create('order_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('order_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('ticket_id')->constrained();
            $table->foreignUuid('seat_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('unit_price', 10, 2);
            $table->string('status', 30)->default('pending');
            $table->string('ticket_code', 100)->nullable()->unique();
            $table->string('purchase_token', 100)->unique();
            $table->string('qr_code')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // 索引
            $table->index(['order_id']);
            $table->index(['ticket_id']);
            $table->index(['seat_id']);
            $table->index(['status']);
            $table->unique(['ticket_id', 'seat_id'], 'order_items_ticket_seat_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

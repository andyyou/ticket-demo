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
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('event_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->nullable(); // null 代表不限制數量
            $table->integer('quantity_sold')->default(0);
            $table->integer('max_per_order')->nullable();
            $table->string('ticket_type', 30)->default('default');
            $table->string('zone_name', 50)->nullable();
            $table->foreignUuid('seat_group_id')->nullable()->constrained()->nullOnDelete();
            $table->dateTime('start_sale_at')->nullable();
            $table->dateTime('end_sale_at')->nullable();
            $table->string('status', 20)->default('inactive');
            $table->timestamps();
            $table->softDeletes();

            // 索引
            $table->index(['event_id']);
            $table->index(['seat_group_id']);
            $table->index(['status', 'start_sale_at', 'end_sale_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

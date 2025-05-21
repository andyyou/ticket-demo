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
        Schema::create('seats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('ticket_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('seat_group_id')->nullable()->constrained()->nullOnDelete();
            $table->string('row_name', 20)->nullable();
            $table->string('seat_number', 20)->nullable();
            $table->string('seat_type', 30)->default('regular');
            $table->string('status', 20)->default('available');
            $table->timestamps();
            $table->softDeletes();

            // 索引
            $table->index(['ticket_id']);
            $table->index(['seat_group_id']);
            $table->index(['status']);
            $table->unique(['ticket_id', 'row_name', 'seat_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};

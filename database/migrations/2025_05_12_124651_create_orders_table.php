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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('order_number', 50)->unique();
            $table->foreignUuid('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignUuid('event_id')->constrained();
            $table->string('status', 30)->default('pending');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone', 20);
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_status', 30)->default('unpaid');
            $table->string('payment_id')->nullable();
            $table->string('payment_provider', 50)->nullable();
            $table->string('payment_provider_merchant_id', 100)->nullable();
            $table->string('payment_provider_order_id', 100)->nullable();
            $table->string('payment_provider_trade_id', 100)->nullable();
            $table->json('payment_details')->nullable();
            $table->dateTime('payment_at')->nullable();
            $table->text('refund_reason')->nullable();
            $table->decimal('refund_amount', 10, 2)->nullable();
            $table->dateTime('refund_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // 索引
            $table->index(['user_id']);
            $table->index(['event_id']);
            $table->index(['payment_provider_order_id']);
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

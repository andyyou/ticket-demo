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
        Schema::create('newsletters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique()->comment('訂閱者電子郵件');
            $table->string('name')->nullable()->comment('訂閱者姓名');
            $table->string('status')->default('active')->comment('訂閱狀態');
            $table->timestamp('subscribed_at')->nullable()->comment('訂閱時間');
            $table->timestamp('unsubscribed_at')->nullable()->comment('取消訂閱時間');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletters');
    }
}; 
<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    /**
     * 訂單狀態列舉
     */
    const STATUS_PENDING = 'pending';
    const STATUS_PENDING_PAYMENT = 'pending_payment';
    const STATUS_PAID = 'paid';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_COMPLETED = 'completed';
    const STATUS_REFUNDING = 'refunding';
    const STATUS_REFUNDED = 'refunded';
    const STATUS_EXPIRED = 'expired';

    /**
     * 付款狀態列舉
     */
    const PAYMENT_UNPAID = 'unpaid';
    const PAYMENT_PENDING = 'pending';
    const PAYMENT_PAID = 'paid';
    const PAYMENT_FAILED = 'failed';
    const PAYMENT_REFUNDED = 'refunded';
    const PAYMENT_PARTIALLY_REFUNDED = 'partially_refunded';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'order_number',
        'user_id',
        'event_id',
        'status',
        'customer_name',
        'customer_email',
        'customer_phone',
        'total_amount',
        'payment_method',
        'payment_status',
        'payment_id',
        'payment_provider',
        'payment_provider_merchant_id',
        'payment_provider_order_id',
        'payment_provider_trade_id',
        'payment_details',
        'payment_at',
        'refund_reason',
        'refund_amount',
        'refund_at',
        'expired_at',
        'cancelled_at',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_amount' => 'decimal:2',
        'refund_amount' => 'decimal:2',
        'payment_details' => 'array',
        'payment_at' => 'datetime',
        'refund_at' => 'datetime',
        'expired_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * 模型啟動時的初始化
     */
    protected static function boot()
    {
        parent::boot();

        // 創建新訂單時自動生成訂單編號
        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = static::generateOrderNumber();
            }
        });
    }

    /**
     * 產生訂單編號
     */
    public static function generateOrderNumber(): string
    {
        $prefix = 'TKT';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
        
        return $prefix . $date . $random;
    }

    /**
     * 用戶關聯
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 活動關聯
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * 訂單項目關聯
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * 表單回應關聯
     */
    public function formResponses(): HasMany
    {
        return $this->hasMany(FormResponse::class);
    }

    /**
     * 檢查訂單是否已付款
     */
    public function isPaid(): bool
    {
        return $this->payment_status === self::PAYMENT_PAID;
    }

    /**
     * 檢查訂單是否已取消
     */
    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    /**
     * 檢查訂單是否已退款
     */
    public function isRefunded(): bool
    {
        return $this->status === self::STATUS_REFUNDED;
    }

    /**
     * 檢查訂單是否已過期
     */
    public function isExpired(): bool
    {
        return $this->status === self::STATUS_EXPIRED;
    }

    /**
     * 檢查訂單是否正在處理中（可修改）
     */
    public function isProcessing(): bool
    {
        return in_array($this->status, [
            self::STATUS_PENDING,
            self::STATUS_PENDING_PAYMENT
        ]);
    }

    /**
     * 將訂單設為已付款
     */
    public function markAsPaid(array $paymentDetails = []): self
    {
        $this->status = self::STATUS_PAID;
        $this->payment_status = self::PAYMENT_PAID;
        $this->payment_at = now();
        
        if (!empty($paymentDetails)) {
            $this->payment_details = $paymentDetails;
        }
        
        $this->save();
        
        // 同時更新所有訂單項目的狀態
        $this->items()->update(['status' => OrderItem::STATUS_PAID]);
        
        return $this;
    }

    /**
     * 取消訂單
     */
    public function cancel(string $reason = null): self
    {
        if (!$this->isProcessing()) {
            throw new \Exception('已經完成付款的訂單無法直接取消');
        }
        
        $this->status = self::STATUS_CANCELLED;
        $this->cancelled_at = now();
        
        if ($reason) {
            $this->refund_reason = $reason;
        }
        
        $this->save();
        
        // 同時取消所有訂單項目
        $this->items()->update(['status' => OrderItem::STATUS_CANCELLED]);
        
        return $this;
    }

    /**
     * 計算訂單總金額
     */
    public function calculateTotal(): self
    {
        $this->total_amount = $this->items()->sum(\DB::raw('unit_price'));
        return $this;
    }
}

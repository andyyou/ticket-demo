<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class OrderItem extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    /**
     * 訂單項目狀態列舉
     */
    const STATUS_PENDING = 'pending';
    const STATUS_RESERVED = 'reserved';
    const STATUS_PAID = 'paid';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_CHECKED_IN = 'checked_in';
    const STATUS_REFUNDED = 'refunded';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'order_id',
        'ticket_id',
        'seat_id',
        'unit_price',
        'status',
        'ticket_code',
        'purchase_token',
        'qr_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'unit_price' => 'decimal:2',
    ];

    /**
     * 模型啟動時的初始化
     */
    protected static function boot()
    {
        parent::boot();

        // 創建新訂單項目時自動生成購買令牌和票券代碼
        static::creating(function ($orderItem) {
            if (empty($orderItem->purchase_token)) {
                $ticketId = $orderItem->ticket_id;
                $timestamp = now()->format('YmdHis');
                $random = Str::random(8);
                $orderItem->purchase_token = "{$ticketId}_{$timestamp}_{$random}";
            }
        });
    }

    /**
     * 訂單關聯
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * 票種關聯
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * 座位關聯
     */
    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }

    /**
     * 簽到紀錄關聯
     */
    public function checkIn(): HasOne
    {
        return $this->hasOne(CheckIn::class);
    }

    /**
     * 產生票券代碼
     */
    public function generateTicketCode(): string
    {
        $prefix = 'T';
        $orderId = substr($this->order_id, 0, 8);
        $random = strtoupper(Str::random(6));
        
        return $prefix . $orderId . $random;
    }

    /**
     * 確認付款並更新票券
     */
    public function confirm(): self
    {
        // 只有當訂單狀態為 pending 或 reserved 時才能確認
        if (!in_array($this->status, [self::STATUS_PENDING, self::STATUS_RESERVED])) {
            throw new \Exception('無法確認此票券，狀態不正確');
        }

        $this->status = self::STATUS_PAID;
        
        // 產生票券代碼
        if (empty($this->ticket_code)) {
            $this->ticket_code = $this->generateTicketCode();
        }

        // 更新座位狀態
        if ($this->seat_id) {
            $this->seat->update(['status' => Seat::STATUS_SOLD]);
        }

        $this->save();
        
        return $this;
    }

    /**
     * 標記為已簽到
     */
    public function markAsCheckedIn(string $checkedInBy = null): self
    {
        if ($this->status !== self::STATUS_PAID) {
            throw new \Exception('此票券尚未付款完成，無法簽到');
        }

        $this->status = self::STATUS_CHECKED_IN;
        $this->save();

        // 創建簽到記錄
        CheckIn::create([
            'order_item_id' => $this->id,
            'checked_in_at' => now(),
            'checked_in_by' => $checkedInBy,
        ]);

        return $this;
    }

    /**
     * 取消訂單項目
     */
    public function cancel(): self
    {
        if (!in_array($this->status, [self::STATUS_PENDING, self::STATUS_RESERVED])) {
            throw new \Exception('已付款的票券無法直接取消，請使用退款流程');
        }

        $this->status = self::STATUS_CANCELLED;
        
        // 釋放座位
        if ($this->seat_id) {
            $this->seat->update(['status' => Seat::STATUS_AVAILABLE]);
        }

        $this->save();
        
        return $this;
    }

    /**
     * 檢查是否為座位票
     */
    public function hasSeat(): bool
    {
        return $this->seat_id !== null;
    }

    /**
     * 取得完整座位資訊
     */
    public function getSeatInfo(): string
    {
        if (!$this->hasSeat()) {
            return '無座位';
        }

        return $this->seat->getZoneName() . ' ' . $this->seat->getFullSeatName();
    }
}

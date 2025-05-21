<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Ticket extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    /**
     * 票券類型列舉
     */
    const TYPE_DEFAULT = 'default';
    const TYPE_SEAT = 'seat';
    const TYPE_DISABLED = 'disabled';
    const TYPE_VIP = 'vip';
    const TYPE_PR = 'pr';

    /**
     * 票種狀態列舉
     */
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'event_id',
        'name',
        'description',
        'price',
        'quantity',
        'quantity_sold',
        'max_per_order',
        'ticket_type',
        'zone_name',
        'seat_group_id',
        'start_sale_at',
        'end_sale_at',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'quantity_sold' => 'integer',
        'max_per_order' => 'integer',
        'start_sale_at' => 'datetime',
        'end_sale_at' => 'datetime',
    ];

    /**
     * 活動關聯
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * 座位組關聯
     */
    public function seatGroup(): BelongsTo
    {
        return $this->belongsTo(SeatGroup::class);
    }

    /**
     * 座位關聯
     */
    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }

    /**
     * 訂單項目關聯
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * 檢查票種是否有庫存限制
     */
    public function hasQuantityLimit(): bool
    {
        return $this->quantity !== null;
    }

    /**
     * 檢查票種是否為座位票
     */
    public function isSeatTicket(): bool
    {
        return $this->ticket_type === self::TYPE_SEAT;
    }

    /**
     * 取得剩餘數量
     */
    public function getRemainingQuantity(): ?int
    {
        if (!$this->hasQuantityLimit()) {
            return null;
        }

        return max(0, $this->quantity - $this->quantity_sold);
    }

    /**
     * 檢查是否在售票時間內
     */
    public function isInSalePeriod(): bool
    {
        $now = Carbon::now();
        return ($this->start_sale_at === null || $now->gte($this->start_sale_at)) &&
               ($this->end_sale_at === null || $now->lte($this->end_sale_at));
    }

    /**
     * 檢查票種是否可售
     */
    public function isAvailable(): bool
    {
        if ($this->status !== self::STATUS_ACTIVE) {
            return false;
        }

        if (!$this->isInSalePeriod()) {
            return false;
        }
        
        if ($this->hasQuantityLimit() && $this->getRemainingQuantity() <= 0) {
            return false;
        }

        return $this->event->isActive();
    }

    /**
     * 取得每筆訂單最大購買數量
     */
    public function getMaxPerOrder(): int
    {
        if ($this->max_per_order !== null) {
            return $this->max_per_order;
        }
        
        // 如果沒有設定限制，但有總數量限制，則使用剩餘數量
        if ($this->hasQuantityLimit()) {
            return $this->getRemainingQuantity();
        }
        
        // 預設值（可以在系統設定中調整）
        return 10;
    }
}

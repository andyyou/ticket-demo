<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    /**
     * 座位類型列舉
     */
    const TYPE_REGULAR = 'regular';
    const TYPE_DISABLED = 'disabled';
    const TYPE_VIP = 'vip';

    /**
     * 座位狀態列舉
     */
    const STATUS_AVAILABLE = 'available';
    const STATUS_RESERVED = 'reserved';
    const STATUS_SOLD = 'sold';
    const STATUS_BLOCKED = 'blocked';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'ticket_id',
        'seat_group_id',
        'row_name',
        'seat_number',
        'seat_type',
        'status',
    ];

    /**
     * 票種關聯
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * 座位組關聯
     */
    public function seatGroup(): BelongsTo
    {
        return $this->belongsTo(SeatGroup::class);
    }

    /**
     * 訂單項目關聯
     */
    public function orderItem(): HasOne
    {
        return $this->hasOne(OrderItem::class);
    }

    /**
     * 取得區域名稱
     */
    public function getZoneName(): string
    {
        return $this->ticket->zone_name ?? '';
    }

    /**
     * 取得完整座位名稱 (如: A-12)
     */
    public function getFullSeatName(): string
    {
        if (!$this->row_name && !$this->seat_number) {
            return '';
        }

        return $this->row_name . '-' . $this->seat_number;
    }

    /**
     * 檢查座位是否可用
     */
    public function isAvailable(): bool
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    /**
     * 檢查座位是否已售出
     */
    public function isSold(): bool
    {
        return $this->status === self::STATUS_SOLD;
    }

    /**
     * 檢查座位是否已預留
     */
    public function isReserved(): bool
    {
        return $this->status === self::STATUS_RESERVED;
    }

    /**
     * 檢查座位是否被封鎖
     */
    public function isBlocked(): bool
    {
        return $this->status === self::STATUS_BLOCKED;
    }
}

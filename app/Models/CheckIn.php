<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckIn extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'order_item_id',
        'checked_in_at',
        'checked_in_by',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'checked_in_at' => 'datetime',
    ];

    /**
     * 訂單項目關聯
     */
    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    /**
     * 簽到人員關聯
     */
    public function checkedInByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_in_by');
    }

    /**
     * 取得簽到人員名稱
     */
    public function getCheckedInByName(): string
    {
        return $this->checkedInByUser->name ?? $this->checked_in_by ?? 'Unknown';
    }

    /**
     * 取得簽到相關票券資訊
     */
    public function getTicketInfo(): array
    {
        if (!$this->orderItem) {
            return [];
        }

        return [
            'ticket_code' => $this->orderItem->ticket_code,
            'ticket_name' => $this->orderItem->ticket->name ?? '',
            'seat_info' => $this->orderItem->getSeatInfo(),
            'customer_name' => $this->orderItem->order->customer_name ?? '',
            'customer_email' => $this->orderItem->order->customer_email ?? '',
            'customer_phone' => $this->orderItem->order->customer_phone ?? '',
            'event_name' => $this->orderItem->ticket->event->title ?? '',
        ];
    }
}

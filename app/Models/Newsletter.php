<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Newsletter extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    /**
     * 訂閱狀態列舉
     */
    const STATUS_ACTIVE = 'active';
    const STATUS_UNSUBSCRIBED = 'unsubscribed';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'name',
        'status',
        'subscribed_at',
        'unsubscribed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    /**
     * 設置訂閱者狀態為活躍
     */
    public function markAsActive(): bool
    {
        $this->status = self::STATUS_ACTIVE;
        $this->subscribed_at = Carbon::now();
        $this->unsubscribed_at = null;
        return $this->save();
    }

    /**
     * 設置訂閱者狀態為取消訂閱
     */
    public function markAsUnsubscribed(): bool
    {
        $this->status = self::STATUS_UNSUBSCRIBED;
        $this->unsubscribed_at = Carbon::now();
        return $this->save();
    }
} 
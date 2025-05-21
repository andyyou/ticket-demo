<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    /**
     * 活動狀態列舉
     */
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_UNPUBLISHED = 'unpublished';

    /**
     * 活動類型列舉
     */
    const TYPE_CONCERT = 'concert';         // 音樂會
    const TYPE_DRAMA = 'drama';             // 戲劇表演
    const TYPE_EXHIBITION = 'exhibition';   // 藝術展覽
    const TYPE_DANCE = 'dance';             // 舞蹈演出
    const TYPE_WORKSHOP = 'workshop';       // 工作坊
    const TYPE_LECTURE = 'lecture';         // 講座
    const TYPE_FESTIVAL = 'festival';       // 藝術節
    const TYPE_OTHER = 'other';             // 其他

    /**
     * 取得所有活動類型的名稱對應
     * 
     * @return array<string, string>
     */
    public static function getTypeNames(): array
    {
        return [
            self::TYPE_CONCERT => '音樂會',
            self::TYPE_DRAMA => '戲劇表演',
            self::TYPE_EXHIBITION => '藝術展覽',
            self::TYPE_DANCE => '舞蹈演出',
            self::TYPE_WORKSHOP => '工作坊',
            self::TYPE_LECTURE => '講座',
            self::TYPE_FESTIVAL => '藝術節',
            self::TYPE_OTHER => '其他',
        ];
    }

    /**
     * 取得活動類型的顯示名稱
     */
    public function getTypeNameAttribute(): string
    {
        return self::getTypeNames()[$this->type] ?? '未分類';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'subtitle',
        'slug',
        'description',
        'venue_name',
        'venue_address',
        'latitude',
        'longitude',
        'timezone',
        'start_at',
        'end_at',
        'publish_at',
        'organizer',
        'featured_image_url',
        'status',
        'type',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'custom_form_id',
        'notes',
        'refund_policy',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'publish_at' => 'datetime',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * 票種關聯
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * 訂單關聯
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * 客製化表單關聯
     */
    public function customForm(): BelongsTo
    {
        return $this->belongsTo(CustomForm::class);
    }

    /**
     * 檢查活動是否已發布
     */
    public function isPublished(): bool
    {
        return $this->status === self::STATUS_PUBLISHED && 
               ($this->publish_at === null || Carbon::now()->gte($this->publish_at));
    }

    /**
     * 檢查活動是否已結束
     */
    public function isEnded(): bool
    {
        return Carbon::now()->gte($this->end_at);
    }

    /**
     * 檢查活動是否活躍（已發布且未結束）
     */
    public function isActive(): bool
    {
        return $this->isPublished() && !$this->isEnded();
    }

    /**
     * 取得已售出票券總數
     */
    public function getTotalTicketsSold(): int
    {
        return $this->tickets()->sum('quantity_sold');
    }
}

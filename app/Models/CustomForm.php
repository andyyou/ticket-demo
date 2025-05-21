<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomForm extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'created_by',
    ];

    /**
     * 建立者關聯
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * 表單欄位關聯
     */
    public function fields(): HasMany
    {
        return $this->hasMany(CustomFormField::class)->orderBy('sort_order');
    }

    /**
     * 表單回應關聯
     */
    public function responses(): HasMany
    {
        return $this->hasManyThrough(FormResponse::class, CustomFormField::class);
    }

    /**
     * 活動關聯
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}

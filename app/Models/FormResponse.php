<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormResponse extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'order_id',
        'custom_form_field_id',
        'value',
    ];

    /**
     * 訂單關聯
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * 表單欄位關聯
     */
    public function field(): BelongsTo
    {
        return $this->belongsTo(CustomFormField::class, 'custom_form_field_id');
    }

    /**
     * 取得表單欄位標籤
     */
    public function getFieldLabel(): string
    {
        return $this->field->label ?? '';
    }

    /**
     * 取得表單欄位類型
     */
    public function getFieldType(): string
    {
        return $this->field->type ?? '';
    }

    /**
     * 根據欄位類型格式化值
     */
    public function getFormattedValue(): string
    {
        $type = $this->getFieldType();
        $value = $this->value;

        if (empty($value)) {
            return '';
        }

        switch ($type) {
            case 'checkbox':
                return $value === '1' ? '是' : '否';
            case 'date':
                return date('Y-m-d', strtotime($value));
            case 'select':
            case 'radio':
                $options = $this->field->options ?? [];
                foreach ($options as $option) {
                    if ($option['value'] === $value) {
                        return $option['label'] ?? $value;
                    }
                }
                return $value;
            default:
                return $value;
        }
    }
}

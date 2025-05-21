<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    /**
     * 設定模型使用 UUID 而不是自增 ID
     */
    public static function bootHasUuid()
    {
        static::creating(function (Model $model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * 取得主鍵類型
     */
    public function getKeyType(): string
    {
        return 'string';
    }

    /**
     * 關閉主鍵自增
     */
    public function getIncrementing(): bool
    {
        return false;
    }
} 
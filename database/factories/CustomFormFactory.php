<?php

namespace Database\Factories;

use App\Models\CustomForm;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomForm>
 */
class CustomFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $formNames = [
            '基本聯絡資訊表單',
            '活動參與調查表',
            '特殊需求登記表',
            '飲食偏好調查',
            'VIP會員資料表',
            '旅遊保險資料收集',
            '藝文活動偏好調查',
            '交通方式選擇'
        ];

        return [
            'id' => Str::uuid(),
            'name' => fake()->randomElement($formNames),
            'description' => fake()->paragraph(),
            'created_by' => User::factory()->create()->id,
        ];
    }
} 
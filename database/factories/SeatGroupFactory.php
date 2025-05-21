<?php

namespace Database\Factories;

use App\Models\SeatGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeatGroup>
 */
class SeatGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $venues = [
            '音樂廳標準配置',
            '小型劇場配置',
            '大型演唱會配置',
            '多功能展演空間',
            '戶外舞台配置',
            '劇院式座位配置',
            '體育場配置',
            '展覽館配置'
        ];

        return [
            'id' => Str::uuid(),
            'name' => fake()->randomElement($venues),
            'description' => fake()->paragraph(2),
        ];
    }
} 
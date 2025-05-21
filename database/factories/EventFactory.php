<?php

namespace Database\Factories;

use App\Models\CustomForm;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(3);
        $slug = Str::slug($title);
        $startAt = fake()->dateTimeBetween('+1 week', '+3 months');
        $endAt = clone $startAt;
        $endAt->modify('+6 hours');
        
        // 台灣縣市
        $cities = [
            '台北市', '新北市', '桃園市', '台中市', '台南市', 
            '高雄市', '基隆市', '新竹市', '嘉義市'
        ];
        
        // 場地名稱
        $venueNames = [
            '文化中心', '藝術展演中心', '音樂廳', '戲劇院', 
            '展覽館', '多功能表演廳', '國際會議中心', '藝文展演空間'
        ];
        
        $venueName = fake()->randomElement($venueNames) . ' - ' . fake()->randomElement($cities);
        
        // 隨機經緯度 (台灣)
        $latitude = fake()->latitude(21.9, 25.3);
        $longitude = fake()->longitude(120.0, 122.0);
        
        // 藝文活動標題片段
        $titleParts = [
            '音樂會', '展覽', '劇場', '演唱會', '舞蹈', '文化節', 
            '藝術節', '戲劇', '演奏會', '發表會', '座談會'
        ];
        
        // 藝文活動主辦單位
        $organizers = [
            '文化部', '國家表演藝術中心', '台灣藝術大學', '國家交響樂團',
            '台北市文化局', '國立故宮博物院', '兩廳院', '衛武營國家藝術文化中心'
        ];
        
        $status = fake()->randomElement([
            Event::STATUS_DRAFT, 
            Event::STATUS_PUBLISHED, 
            Event::STATUS_UNPUBLISHED
        ]);
        
        // 生成帶有藝文特色的標題
        $title = fake()->sentence(2) . ' ' . fake()->randomElement($titleParts);
        
        return [
            'id' => Str::uuid(),
            'title' => $title,
            'subtitle' => fake()->boolean(70) ? fake()->sentence(4) : null,
            'slug' => $slug,
            'description' => fake()->paragraphs(3, true),
            'venue_name' => $venueName,
            'venue_address' => fake()->address(),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'timezone' => 'Asia/Taipei',
            'start_at' => $startAt,
            'end_at' => $endAt,
            'publish_at' => $status === Event::STATUS_PUBLISHED ? now() : null,
            'organizer' => fake()->randomElement($organizers),
            'featured_image_url' => 'https://picsum.photos/800/600?random=' . rand(1, 1000),
            'status' => $status,
            'meta_title' => $title,
            'meta_description' => fake()->sentence(10),
            'meta_keywords' => implode(',', fake()->words(5)),
            'custom_form_id' => fake()->boolean(60) ? CustomForm::factory() : null,
            'notes' => fake()->boolean(50) ? fake()->paragraph() : null,
            'refund_policy' => fake()->boolean(70) ? fake()->paragraph() : null,
        ];
    }

    /**
     * 設置為已發布狀態
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Event::STATUS_PUBLISHED,
            'publish_at' => now(),
        ]);
    }

    /**
     * 設置為草稿狀態
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Event::STATUS_DRAFT,
            'publish_at' => null,
        ]);
    }

    /**
     * 設置為下架狀態
     */
    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Event::STATUS_UNPUBLISHED,
            'publish_at' => null,
        ]);
    }
} 
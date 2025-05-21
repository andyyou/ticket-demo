<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\SeatGroup;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ticketTypes = [
            Ticket::TYPE_DEFAULT, 
            Ticket::TYPE_SEAT, 
            Ticket::TYPE_VIP, 
            Ticket::TYPE_PR
        ];
        
        $ticketType = fake()->randomElement($ticketTypes);
        
        $ticketNames = [
            Ticket::TYPE_DEFAULT => ['全票', '學生票', '早鳥票', '團體票', '標準票'],
            Ticket::TYPE_SEAT => ['座位票', '指定座位', '劇院座位'],
            Ticket::TYPE_VIP => ['VIP票', '貴賓票', '特等票', '豪華票'],
            Ticket::TYPE_PR => ['媒體票', '公關票', '嘉賓票', '特邀票']
        ];
        
        $event = Event::factory()->create();
        $startSaleAt = fake()->dateTimeBetween('-1 month', $event->start_at);
        $endSaleAt = fake()->dateTimeBetween($startSaleAt, $event->start_at);
        
        // 門票價格範圍 (依票種類型)
        $priceRanges = [
            Ticket::TYPE_DEFAULT => [300, 800],
            Ticket::TYPE_SEAT => [500, 1200],
            Ticket::TYPE_VIP => [1500, 3500],
            Ticket::TYPE_PR => [0, 0], // 公關票通常免費
        ];
        
        $priceRange = $priceRanges[$ticketType];
        $price = ($priceRange[0] === $priceRange[1]) 
            ? $priceRange[0] 
            : fake()->numberBetween($priceRange[0], $priceRange[1]);
            
        // 四捨五入到百位數
        $price = ceil($price / 100) * 100;
        
        $quantity = ($ticketType === Ticket::TYPE_SEAT) 
            ? null // 座位票由座位數量決定
            : fake()->numberBetween(50, 500);
        
        $seatGroup = ($ticketType === Ticket::TYPE_SEAT)
            ? SeatGroup::factory()->create()
            : null;
            
        $zoneNames = [
            'A 區', 'B 區', 'C 區', 'VIP 區', '看台區', 
            '中央區', '兩側區', '後方區', '舞台前區'
        ];
        
        $zoneName = ($ticketType === Ticket::TYPE_SEAT)
            ? fake()->randomElement($zoneNames)
            : null;
            
        return [
            'id' => Str::uuid(),
            'event_id' => $event->id,
            'name' => fake()->randomElement($ticketNames[$ticketType]),
            'description' => fake()->paragraph(),
            'price' => $price,
            'quantity' => $quantity,
            'quantity_sold' => 0,
            'max_per_order' => fake()->numberBetween(2, 10),
            'ticket_type' => $ticketType,
            'zone_name' => $zoneName,
            'seat_group_id' => $seatGroup?->id,
            'start_sale_at' => $startSaleAt,
            'end_sale_at' => $endSaleAt,
            'status' => fake()->randomElement([
                Ticket::STATUS_ACTIVE, 
                Ticket::STATUS_INACTIVE
            ]),
        ];
    }

    /**
     * 設置為普通票種
     */
    public function default(): static
    {
        return $this->state(fn (array $attributes) => [
            'ticket_type' => Ticket::TYPE_DEFAULT,
            'seat_group_id' => null,
            'zone_name' => null,
            'quantity' => fake()->numberBetween(50, 500),
        ]);
    }

    /**
     * 設置為座位票
     */
    public function seat(SeatGroup $seatGroup = null): static
    {
        $seatGroup = $seatGroup ?? SeatGroup::factory()->create();
        
        return $this->state(fn (array $attributes) => [
            'ticket_type' => Ticket::TYPE_SEAT,
            'seat_group_id' => $seatGroup->id,
            'zone_name' => fake()->randomElement(['A 區', 'B 區', 'C 區', 'VIP 區']),
            'quantity' => null,
        ]);
    }

    /**
     * 設置為 VIP 票
     */
    public function vip(): static
    {
        return $this->state(fn (array $attributes) => [
            'ticket_type' => Ticket::TYPE_VIP,
            'name' => fake()->randomElement(['VIP票', '貴賓票', '特等票']),
            'price' => fake()->numberBetween(1500, 3500),
            'quantity' => fake()->numberBetween(10, 50),
        ]);
    }

    /**
     * 設置為有效狀態
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Ticket::STATUS_ACTIVE,
        ]);
    }

    /**
     * 設置為停用狀態
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Ticket::STATUS_INACTIVE,
        ]);
    }
} 
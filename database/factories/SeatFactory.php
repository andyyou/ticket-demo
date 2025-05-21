<?php

namespace Database\Factories;

use App\Models\Seat;
use App\Models\SeatGroup;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ticket = Ticket::factory()->seat()->create();
        $seatGroup = $ticket->seatGroup;
        
        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
        $rowName = fake()->randomElement($rows);
        $seatNumber = fake()->numberBetween(1, 30);
        
        $seatTypes = [
            Seat::TYPE_REGULAR => 90,
            Seat::TYPE_VIP => 5,
            Seat::TYPE_DISABLED => 5,
        ];
        
        $seatType = fake()->randomElement(array_keys($seatTypes));
        
        $statuses = [
            Seat::STATUS_AVAILABLE => 80,
            Seat::STATUS_RESERVED => 10,
            Seat::STATUS_SOLD => 10,
        ];
        
        $status = fake()->randomElement(array_keys($statuses));
        
        return [
            'id' => Str::uuid(),
            'ticket_id' => $ticket->id,
            'seat_group_id' => $seatGroup->id,
            'row_name' => $rowName,
            'seat_number' => $seatNumber,
            'seat_type' => $seatType,
            'status' => $status,
        ];
    }

    /**
     * 設置為可用狀態
     */
    public function available(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Seat::STATUS_AVAILABLE,
        ]);
    }

    /**
     * 設置為已預訂狀態
     */
    public function reserved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Seat::STATUS_RESERVED,
        ]);
    }

    /**
     * 設置為已售出狀態
     */
    public function sold(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Seat::STATUS_SOLD,
        ]);
    }

    /**
     * 設置為已封鎖狀態
     */
    public function blocked(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Seat::STATUS_BLOCKED,
        ]);
    }

    /**
     * 批量建立特定座位組和票種的座位
     */
    public static function createSeatsForTicket(Ticket $ticket, int $rowCount = 5, int $seatsPerRow = 10): void
    {
        if (!$ticket->isSeatTicket() || !$ticket->seatGroup) {
            throw new \Exception('只能為座位票建立座位');
        }
        
        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];
        
        for ($r = 0; $r < $rowCount; $r++) {
            $rowName = $rows[$r];
            
            for ($s = 1; $s <= $seatsPerRow; $s++) {
                // 隨機設定一些座位為特殊類型
                $seatType = Seat::TYPE_REGULAR;
                
                // 最後一排有些是殘障座位
                if ($r == $rowCount - 1 && $s <= 2) {
                    $seatType = Seat::TYPE_DISABLED;
                }
                
                // 第一排中間部分是VIP座位
                if ($r == 0 && $s >= 3 && $s <= 7) {
                    $seatType = Seat::TYPE_VIP;
                }
                
                Seat::create([
                    'id' => Str::uuid(),
                    'ticket_id' => $ticket->id,
                    'seat_group_id' => $ticket->seatGroup->id,
                    'row_name' => $rowName,
                    'seat_number' => $s,
                    'seat_type' => $seatType,
                    'status' => Seat::STATUS_AVAILABLE,
                ]);
            }
        }
    }
} 
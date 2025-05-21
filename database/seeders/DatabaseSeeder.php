<?php

namespace Database\Seeders;

use App\Models\CustomForm;
use App\Models\CustomFormField;
use App\Models\Event;
use App\Models\FormResponse;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Seat;
use App\Models\SeatGroup;
use App\Models\Ticket;
use App\Models\User;
use Database\Factories\SeatFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. 創建管理員用戶
        $admin = User::create([
            'id' => Str::uuid(),
            'name' => '系統管理員',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        // 2. 創建工作人員
        $staff = User::create([
            'id' => Str::uuid(),
            'name' => '工作人員',
            'email' => 'staff@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'role' => 'staff',
        ]);

        // 3. 創建一般用戶
        $customer = User::create([
            'id' => Str::uuid(),
            'name' => '測試用戶',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'role' => 'customer',
        ]);

        // 4. 創建座位組
        $seatGroup = SeatGroup::create([
            'id' => Str::uuid(),
            'name' => '音樂廳標準配置',
            'description' => '音樂廳標準座位配置，共有 A-E 排，每排 10 個座位'
        ]);

        // 5. 創建客製化表單
        $customForm = CustomForm::create([
            'id' => Str::uuid(),
            'name' => '基本聯絡資訊表單',
            'description' => '收集參與者的基本聯絡資訊',
            'created_by' => $admin->id,
        ]);

        $field1 = CustomFormField::create([
            'id' => Str::uuid(),
            'custom_form_id' => $customForm->id,
            'label' => '緊急聯絡人',
            'type' => 'text',
            'is_required' => true,
            'sort_order' => 1,
        ]);

        $field2 = CustomFormField::create([
            'id' => Str::uuid(),
            'custom_form_id' => $customForm->id,
            'label' => '緊急聯絡人電話',
            'type' => 'text',
            'is_required' => true,
            'sort_order' => 2,
        ]);

        $field3 = CustomFormField::create([
            'id' => Str::uuid(),
            'custom_form_id' => $customForm->id,
            'label' => '飲食偏好',
            'type' => 'radio',
            'options' => [
                ['value' => 'normal', 'label' => '葷食'],
                ['value' => 'vegetarian', 'label' => '素食'],
            ],
            'is_required' => true,
            'sort_order' => 3,
        ]);

        // 6. 創建活動
        $event = Event::create([
            'id' => Str::uuid(),
            'title' => '2025 台北春季音樂會',
            'subtitle' => '古典樂的饗宴',
            'slug' => '2025-taipei-spring-concert',
            'description' => "台北春季音樂會是一年一度的古典音樂盛事，匯集了國內外頂尖音樂家，呈現最精彩的古典樂章。\n\n今年的音樂會將由國際知名指揮大師王大衛領銜，與台北交響樂團共同演出貝多芬、莫札特等經典作品。",
            'venue_name' => '台北音樂廳',
            'venue_address' => '台北市中山區中山北路三段25號',
            'latitude' => 25.0408,
            'longitude' => 121.5221,
            'timezone' => 'Asia/Taipei',
            'start_at' => now()->addMonth(),
            'end_at' => now()->addMonth()->addHours(3),
            'publish_at' => now(),
            'organizer' => '台北市文化局',
            'featured_image_url' => 'https://picsum.photos/800/600?random=25',
            'status' => Event::STATUS_PUBLISHED,
            'type' => Event::TYPE_CONCERT,
            'custom_form_id' => $customForm->id,
            'notes' => '請提前 30 分鐘入場',
            'refund_policy' => '活動前 7 天可申請全額退款，7 天內不接受退款',
        ]);

        // 創建更多不同類型的活動
        $dramaEvent = Event::create([
            'id' => Str::uuid(),
            'title' => '幕後的秘密：展演藝術工作坊',
            'subtitle' => '探索劇場製作的幕後故事',
            'slug' => 'behind-the-scenes-workshop',
            'description' => "一場專為藝術愛好者設計的工作坊，探索劇場幕後的製作秘密。透過專業導演和舞台設計師的引導，參與者將了解舞台劇製作的各個環節，從劇本解析、角色塑造、燈光音效到舞台設計。",
            'venue_name' => '台北文創中心',
            'venue_address' => '台北市信義區光復南路133號',
            'latitude' => 25.0433,
            'longitude' => 121.5605,
            'timezone' => 'Asia/Taipei',
            'start_at' => now()->addMonths(2),
            'end_at' => now()->addMonths(2)->addHours(4),
            'publish_at' => now(),
            'organizer' => '台北藝術基金會',
            'featured_image_url' => 'https://picsum.photos/800/600?random=26',
            'status' => Event::STATUS_PUBLISHED,
            'type' => Event::TYPE_WORKSHOP,
            'custom_form_id' => $customForm->id,
            'notes' => '適合對表演藝術有興趣的人士參加，無需經驗',
            'refund_policy' => '活動前 14 天可申請全額退款，7-14 天內可申請 50% 退款，7 天內不接受退款',
        ]);

        $danceEvent = Event::create([
            'id' => Str::uuid(),
            'title' => '現代舞蹈：城市之聲',
            'subtitle' => '當代舞蹈的詩意表達',
            'slug' => 'modern-dance-city-voice',
            'description' => "探索現代舞蹈與都市生活的交響，由新生代舞者演繹當代生活的律動。本演出由知名編舞家陳美玲帶領的舞團，透過現代舞蹈語彙，詮釋都市中的人文風景和情感流動。",
            'venue_name' => '台北當代藝術中心',
            'venue_address' => '台北市大安區仁愛路四段49號',
            'latitude' => 25.0379,
            'longitude' => 121.5448,
            'timezone' => 'Asia/Taipei',
            'start_at' => now()->addMonths(3),
            'end_at' => now()->addMonths(3)->addHours(2),
            'publish_at' => now(),
            'organizer' => '台灣當代舞蹈團',
            'featured_image_url' => 'https://picsum.photos/800/600?random=27',
            'status' => Event::STATUS_PUBLISHED,
            'type' => Event::TYPE_DANCE,
            'custom_form_id' => $customForm->id,
            'notes' => '全長 90 分鐘，中間無休息',
            'refund_policy' => '活動前 7 天可申請全額退款，7 天內不接受退款',
        ]);

        $exhibitionEvent = Event::create([
            'id' => Str::uuid(),
            'title' => '當代藝術展：跨界對話',
            'subtitle' => '傳統與現代的碰撞',
            'slug' => 'contemporary-art-exhibition',
            'description' => "本次展覽匯聚十位台灣當代藝術家的作品，探討東方傳統美學與西方現代藝術的對話。展出作品包括裝置藝術、影像創作、雕塑及互動藝術等多元形式，反思全球化背景下的文化認同與藝術創新。",
            'venue_name' => '台北市立美術館',
            'venue_address' => '台北市中山區中山北路三段181號',
            'latitude' => 25.0725,
            'longitude' => 121.5249,
            'timezone' => 'Asia/Taipei',
            'start_at' => now()->addWeeks(2),
            'end_at' => now()->addMonths(2),
            'publish_at' => now(),
            'organizer' => '台北市立美術館',
            'featured_image_url' => 'https://picsum.photos/800/600?random=28',
            'status' => Event::STATUS_PUBLISHED,
            'type' => Event::TYPE_EXHIBITION,
            'custom_form_id' => $customForm->id,
            'notes' => '每週一休館，開放時間 9:30-17:30',
            'refund_policy' => '購票後不接受退款，可轉讓',
        ]);

        $jazzEvent = Event::create([
            'id' => Str::uuid(),
            'title' => '爵士之夜：即興與創新',
            'subtitle' => '爵士樂的魅力之夜',
            'slug' => 'jazz-night-improvisation',
            'description' => "一場充滿活力的爵士樂演出，結合經典曲目與現代即興創作，帶您進入爵士樂的魅力世界。由國際知名薩克斯風演奏家李大川領銜，與一流爵士樂團共同演出。",
            'venue_name' => '藍調爵士酒吧',
            'venue_address' => '台北市大安區安和路一段78號',
            'latitude' => 25.0278,
            'longitude' => 121.5520,
            'timezone' => 'Asia/Taipei',
            'start_at' => now()->addMonths(4),
            'end_at' => now()->addMonths(4)->addHours(3),
            'publish_at' => now(),
            'organizer' => '台北爵士協會',
            'featured_image_url' => 'https://picsum.photos/800/600?random=29',
            'status' => Event::STATUS_PUBLISHED,
            'type' => Event::TYPE_CONCERT,
            'custom_form_id' => $customForm->id,
            'notes' => '適合 18 歲以上觀眾，現場提供酒水點心（需另費）',
            'refund_policy' => '活動前 7 天可申請 80% 退款，7 天內不接受退款',
        ]);

        $lectureEvent = Event::create([
            'id' => Str::uuid(),
            'title' => '藝術賞析公開講座',
            'subtitle' => '走進大師的創作世界',
            'slug' => 'art-appreciation-lecture',
            'description' => "由知名藝術史學者王雅芬教授主講，深入淺出地介紹西洋藝術史上的重要流派和代表人物。本講座將帶領聽眾認識印象派、後印象派、立體派等重要藝術運動的特色與影響。",
            'venue_name' => '台北文化大學推廣部',
            'venue_address' => '台北市中正區許昌街17號',
            'latitude' => 25.0457,
            'longitude' => 121.5152,
            'timezone' => 'Asia/Taipei',
            'start_at' => now()->addWeeks(3),
            'end_at' => now()->addWeeks(3)->addHours(2),
            'publish_at' => now(),
            'organizer' => '台灣藝術教育協會',
            'featured_image_url' => 'https://picsum.photos/800/600?random=30',
            'status' => Event::STATUS_PUBLISHED,
            'type' => Event::TYPE_LECTURE,
            'custom_form_id' => $customForm->id,
            'notes' => '講座後有 30 分鐘 Q&A 時間',
            'refund_policy' => '活動前 3 天可申請全額退款，3 天內不接受退款',
        ]);

        // 7. 創建票種
        $normalTicket = Ticket::create([
            'id' => Str::uuid(),
            'event_id' => $event->id,
            'name' => '全票',
            'description' => '一般觀眾票券',
            'price' => 500,
            'quantity' => 100,
            'quantity_sold' => 0,
            'max_per_order' => 4,
            'ticket_type' => Ticket::TYPE_DEFAULT,
            'start_sale_at' => now(),
            'end_sale_at' => now()->addWeeks(3),
            'status' => Ticket::STATUS_ACTIVE,
        ]);

        $studentTicket = Ticket::create([
            'id' => Str::uuid(),
            'event_id' => $event->id,
            'name' => '學生票',
            'description' => '需出示學生證',
            'price' => 300,
            'quantity' => 50,
            'quantity_sold' => 0,
            'max_per_order' => 2,
            'ticket_type' => Ticket::TYPE_DEFAULT,
            'start_sale_at' => now(),
            'end_sale_at' => now()->addWeeks(3),
            'status' => Ticket::STATUS_ACTIVE,
        ]);

        $seatTicket = Ticket::create([
            'id' => Str::uuid(),
            'event_id' => $event->id,
            'name' => '指定座位票',
            'description' => '可選擇座位',
            'price' => 800,
            'ticket_type' => Ticket::TYPE_SEAT,
            'zone_name' => 'A 區',
            'seat_group_id' => $seatGroup->id,
            'start_sale_at' => now(),
            'end_sale_at' => now()->addWeeks(3),
            'status' => Ticket::STATUS_ACTIVE,
        ]);

        // 8. 為座位票創建座位
        $rows = ['A', 'B', 'C', 'D', 'E'];
        foreach ($rows as $row) {
            for ($i = 1; $i <= 10; $i++) {
                Seat::create([
                    'id' => Str::uuid(),
                    'ticket_id' => $seatTicket->id,
                    'seat_group_id' => $seatGroup->id,
                    'row_name' => $row,
                    'seat_number' => $i,
                    'seat_type' => Seat::TYPE_REGULAR,
                    'status' => Seat::STATUS_AVAILABLE,
                ]);
            }
        }

        // 9. 創建訂單
        $order = Order::create([
            'id' => Str::uuid(),
            'order_number' => Order::generateOrderNumber(),
            'user_id' => $customer->id,
            'event_id' => $event->id,
            'status' => Order::STATUS_PAID,
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'customer_phone' => '0912345678',
            'total_amount' => $normalTicket->price * 2,
            'payment_method' => 'credit_card',
            'payment_status' => Order::PAYMENT_PAID,
            'payment_provider' => 'newebpay',
            'payment_at' => now(),
        ]);

        // 10. 創建訂單項目
        for ($i = 0; $i < 2; $i++) {
            OrderItem::create([
                'id' => Str::uuid(),
                'order_id' => $order->id,
                'ticket_id' => $normalTicket->id,
                'unit_price' => $normalTicket->price,
                'status' => OrderItem::STATUS_PAID,
                'ticket_code' => 'T' . substr($order->id, 0, 8) . strtoupper(Str::random(6)),
                'purchase_token' => Str::random(32),
            ]);
        }

        // 11. 更新票種已售數量
        $normalTicket->increment('quantity_sold', 2);

        // 12. 創建表單回應
        FormResponse::create([
            'id' => Str::uuid(),
            'order_id' => $order->id,
            'custom_form_field_id' => $field1->id,
            'value' => '張小明',
        ]);

        FormResponse::create([
            'id' => Str::uuid(),
            'order_id' => $order->id,
            'custom_form_field_id' => $field2->id,
            'value' => '0987654321',
        ]);

        FormResponse::create([
            'id' => Str::uuid(),
            'order_id' => $order->id,
            'custom_form_field_id' => $field3->id,
            'value' => 'normal',
        ]);
    }
}

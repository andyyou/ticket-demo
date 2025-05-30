# 藝文售票平台資料庫設計 (精簡版)

本文件詳細描述藝文售票平台應用的資料庫結構設計，基於小型藝文公司的需求進行精簡，專注於核心功能。根據 Laravel 最佳實踐進行調整，盡可能使用框架內建功能。

## 資料模型概覽

以下是系統的核心資料模型：

1. User - 用戶模型
2. Event - 活動模型
3. Ticket - 票種模型
4. SeatGroup - 座位組模型
5. Seat - 座位模型
6. Order - 訂單模型
7. OrderItem - 訂單票券項目
8. CustomForm - 客製化表單
9. CustomFormField - 表單欄位
10. FormResponse - 表單回應數據
11. CheckIn - 活動簽到記錄

## 資料表欄位設計

### 1. users (用戶表)

-   `id` - uuid, primary key - 用戶唯一識別碼
-   `name` - varchar(255), not null - 用戶姓名
-   `email` - varchar(255), not null, unique - 電子郵件
-   `email_verified_at` - timestamp, nullable - 電子郵件驗證時間
-   `password` - varchar(255), not null - 密碼（雜湊後）
-   `phone` - varchar(20), nullable - 電話號碼
-   `role` - varchar(30), default 'customer' - 用戶角色 (在 Model 層使用 enum)
-   `remember_token` - varchar(100), nullable - 記住我令牌 (Laravel 內建)
-   `provider` - varchar(50), nullable - 第三方登入提供者
-   `provider_id` - varchar(255), nullable - 第三方登入識別碼
-   `created_at` - timestamp, not null
-   `updated_at` - timestamp, not null
-   `deleted_at` - timestamp, nullable - 軟刪除標記 (Laravel SoftDeletes)

> 注意：使用 Laravel Sanctum 管理 API 令牌，不需要在用戶表中添加額外欄位

### 2. events (活動表)

-   `id` - uuid, primary key - 活動唯一識別碼
-   `title` - varchar(255), not null - 活動標題
-   `subtitle` - varchar(255), nullable - 活動副標題
-   `slug` - varchar(255), not null, unique - 活動網址識別碼
-   `description` - text, nullable - 活動詳細描述
-   `venue_name` - varchar(255), not null - 場地名稱
-   `venue_address` - varchar(255), nullable - 場地地址
-   `latitude` - decimal(10, 8), nullable - 緯度（地圖標記用）
-   `longitude` - decimal(11, 8), nullable - 經度（地圖標記用）
-   `timezone` - varchar(50), not null, default 'Asia/Taipei' - 活動時區
-   `start_at` - datetime, not null - 活動開始日期時間
-   `end_at` - datetime, not null - 活動結束日期時間
-   `publish_at` - datetime, nullable - 發布日期時間
-   `organizer` - varchar(255), nullable - 主辦單位名稱
-   `featured_image_url` - varchar(255), nullable - 主要圖片網址
-   `status` - varchar(20), default 'draft' - 活動狀態 (在 Model 層使用 enum: draft, published, unpublished)
-   `meta_title` - varchar(255), nullable - SEO 標題
-   `meta_description` - text, nullable - SEO 描述
-   `meta_keywords` - varchar(255), nullable - SEO 關鍵字
-   `custom_form_id` - uuid, nullable, foreign key - 客製化表單外鍵
-   `notes` - text, nullable - 活動注意事項
-   `refund_policy` - text, nullable - 退款政策
-   `created_at` - timestamp, not null
-   `updated_at` - timestamp, not null
-   `deleted_at` - timestamp, nullable - 軟刪除標記 (Laravel SoftDeletes)

### 3. seat_groups (座位組表)

-   `id` - uuid, primary key - 座位組唯一識別碼
-   `name` - varchar(255), not null - 座位組名稱（例如：「音樂廳 A 廳配置」、「體育館標準配置」）
-   `description` - text, nullable - 座位組描述
-   `created_at` - timestamp, not null
-   `updated_at` - timestamp, not null
-   `deleted_at` - timestamp, nullable - 軟刪除標記 (Laravel SoftDeletes)

### 4. tickets (票種表)

-   `id` - uuid, primary key - 票種唯一識別碼
-   `event_id` - uuid, not null, foreign key - 活動外鍵
-   `name` - varchar(255), not null - 票種名稱
-   `description` - text, nullable - 票種描述
-   `price` - decimal(10, 2), not null - 價格
-   `quantity` - int, nullable - 總數量 (null 代表不限制數量)
-   `quantity_sold` - int, default 0 - 已售出數量
-   `max_per_order` - int, nullable - 每筆訂單限購數量
-   `ticket_type` - varchar(30), default 'default' - 票券類型 (在 Model 層使用 enum: default, seat, disabled, vip, pr)
-   `zone_name` - varchar(50), nullable - 區域名稱 (例如：貴賓區、A 區、紅 1 區)
-   `seat_group_id` - uuid, nullable, foreign key - 座位組外鍵 (如果使用座位組)
-   `start_sale_at` - datetime, nullable - 開始售票時間
-   `end_sale_at` - datetime, nullable - 結束售票時間
-   `status` - varchar(20), default 'inactive' - 票種狀態 (在 Model 層使用 enum)
-   `created_at` - timestamp, not null
-   `updated_at` - timestamp, not null
-   `deleted_at` - timestamp, nullable - 軟刪除標記 (Laravel SoftDeletes)

### 5. seats (座位表)

-   `id` - uuid, primary key - 座位唯一識別碼
-   `ticket_id` - uuid, not null, foreign key - 票種外鍵
-   `seat_group_id` - uuid, nullable, foreign key - 座位組外鍵
-   `row_name` - varchar(20), nullable - 排名 (例如：A、B、C 或 1、2、3)
-   `seat_number` - varchar(20), nullable - 座位編號
-   `seat_type` - varchar(30), default 'regular' - 座位類型 (在 Model 層使用 enum: regular, disabled, vip)
-   `status` - varchar(20), default 'available' - 座位狀態 (在 Model 層使用 enum: available, reserved, sold, blocked)
-   `created_at` - timestamp, not null
-   `updated_at` - timestamp, not null
-   `deleted_at` - timestamp, nullable - 軟刪除標記 (Laravel SoftDeletes)
-   UNIQUE INDEX (`ticket_id`, `row_name`, `seat_number`) - 確保同一活動的座位不重複

### 6. orders (訂單表)

-   `id` - uuid, primary key - 訂單唯一識別碼
-   `order_number` - varchar(50), not null, unique - 訂單編號 (系統生成)
-   `user_id` - uuid, nullable, foreign key - 用戶外鍵（可為空，支援非會員購票）
-   `event_id` - uuid, not null, foreign key - 活動外鍵
-   `status` - varchar(30), default 'pending' - 訂單狀態 (在 Model 層使用 enum)
-   `customer_name` - varchar(255), not null - 購票人姓名
-   `customer_email` - varchar(255), not null - 購票人電子郵件
-   `customer_phone` - varchar(20), not null - 購票人電話
-   `total_amount` - decimal(10, 2), not null - 訂單總金額
-   `payment_method` - varchar(50), nullable - 付款方式
-   `payment_status` - varchar(30), default 'unpaid' - 付款狀態 (在 Model 層使用 enum)
-   `payment_id` - varchar(255), nullable - 第三方支付識別碼
-   `payment_provider` - varchar(50), nullable - 支付提供者 (如 NewebPay, Stripe, LinePay)
-   `payment_provider_merchant_id` - varchar(100), nullable - 金流服務商店代號
-   `payment_provider_order_id` - varchar(100), nullable - 金流服務訂單編號
-   `payment_provider_trade_id` - varchar(100), nullable - 金流交易編號
-   `payment_details` - json, nullable - 支付詳細資訊
-   `payment_at` - datetime, nullable - 付款時間
-   `refund_reason` - text, nullable - 退款原因
-   `refund_amount` - decimal(10, 2), nullable - 退款金額
-   `refund_at` - datetime, nullable - 退款日期
-   `expired_at` - datetime, nullable - 訂單過期時間 (pending 訂單的有效期限)
-   `cancelled_at` - timestamp, nullable - 取消時間
-   `completed_at` - timestamp, nullable - 完成時間
-   `created_at` - timestamp, not null
-   `updated_at` - timestamp, not null
-   `deleted_at` - timestamp, nullable - 軟刪除標記 (Laravel SoftDeletes)

### 7. order_items (訂單項目表)

-   `id` - uuid, primary key - 訂單項目唯一識別碼
-   `order_id` - uuid, not null, foreign key - 訂單外鍵
-   `ticket_id` - uuid, not null, foreign key - 票種外鍵
-   `seat_id` - uuid, nullable, foreign key - 座位外鍵 (如適用)
-   `unit_price` - decimal(10, 2), not null - 單價
-   `status` - varchar(30), default 'pending' - 票券狀態 (在 Model 層使用 enum)
-   `ticket_code` - varchar(100), nullable - 票券代碼 (一票一碼)
-   `purchase_token` - varchar(100), not null - 購買令牌 (防止高併發重複購買)
-   `qr_code` - varchar(255), nullable - QR Code 路徑
-   `created_at` - timestamp, not null
-   `updated_at` - timestamp, not null
-   `deleted_at` - timestamp, nullable - 軟刪除標記 (Laravel SoftDeletes)
-   UNIQUE INDEX (`ticket_id`, `seat_id`) - 確保座位不被重複售出 (對座位票)
-   UNIQUE INDEX (`purchase_token`) - 確保購買令牌唯一 (高併發防重複購買)

### 8. custom_forms (客製化表單表)

-   `id` - uuid, primary key - 表單唯一識別碼
-   `name` - varchar(255), not null - 表單名稱
-   `description` - text, nullable - 表單描述
-   `created_by` - uuid, not null, foreign key references users(id) - 建立者
-   `created_at` - timestamp, not null
-   `updated_at` - timestamp, not null
-   `deleted_at` - timestamp, nullable - 軟刪除標記 (Laravel SoftDeletes)

### 9. custom_form_fields (表單欄位表)

-   `id` - uuid, primary key - 欄位唯一識別碼
-   `custom_form_id` - uuid, not null, foreign key - 表單外鍵
-   `label` - varchar(255), not null - 欄位標籤
-   `type` - varchar(30), not null - 欄位類型 (在 Model 層使用 enum: text, number, select, checkbox, radio, date, textarea)
-   `options` - json, nullable - 選項配置（用於 select、checkbox、radio）
-   `is_required` - boolean, default false - 是否必填
-   `placeholder` - varchar(255), nullable - 預設提示文字
-   `help_text` - text, nullable - 輔助說明
-   `sort_order` - int, default 0 - 排序順序
-   `created_at` - timestamp, not null
-   `updated_at` - timestamp, not null

### 10. form_responses (表單回應表)

-   `id` - uuid, primary key - 回應唯一識別碼
-   `order_id` - uuid, not null, foreign key - 訂單外鍵
-   `custom_form_field_id` - uuid, not null, foreign key - 表單欄位外鍵
-   `value` - text, nullable - 用戶填寫的值
-   `created_at` - timestamp, not null
-   `updated_at` - timestamp, not null

### 11. check_ins (簽到記錄表)

-   `id` - uuid, primary key - 簽到唯一識別碼
-   `order_item_id` - uuid, not null, foreign key - 訂單項目外鍵
-   `checked_in_at` - datetime, not null - 簽到時間
-   `checked_in_by` - uuid, nullable, foreign key references users(id) - 簽到執行者
-   `notes` - text, nullable - 備註
-   `created_at` - timestamp, not null
-   `updated_at` - timestamp, not null

## 座位組與座位設計

座位組(SeatGroup)的設計可以讓場地座位配置可重複使用，避免每次活動都需重新設定座位：

1. **座位資料的重複使用**：座位組代表一個場地的基本配置，可以被多個活動的票種引用。
2. **實際使用流程**：
    - 管理員創建座位組（如「音樂廳標準配置」）
    - 定義座位排列（row_name、seat_number 及類型）
    - 建立活動票種時，關聯到該座位組
    - 系統根據關聯自動建立實際可售的座位

## 防止高併發超賣機制

### 針對座位票

對於有固定座位的票券，使用資料庫唯一約束來保證一個座位只能售出一次：

-   在 `order_items` 表中設置 `UNIQUE INDEX (ticket_id, seat_id)`
-   購買流程中，先嘗試預留座位（更新 seats 表狀態）
-   使用資料庫事務確保原子性

### 針對一般票券（無座位）

對於無固定座位的票券，採用以下策略：

1. **購買令牌機制**：

    - 在 `order_items` 表中添加 `purchase_token` 欄位，並設為唯一索引
    - 購票時生成唯一令牌：如 `{ticket_id}_{timestamp}_{random_string}`
    - 使用資料庫唯一約束確保令牌不重複

2. **庫存鎖定策略**：
    - 使用 Redis 進行庫存預扣減
    - 購票時使用 Redis 原子操作減少可用庫存
    - 訂單過期或取消時返還庫存
    - 使用 Laravel 隊列處理訂單過期自動釋放庫存

## 資料表關聯

### 一對多關聯

-   User → Order：一個用戶可以有多個訂單
-   Event → Ticket：一個活動可以有多個票種
-   Event → Order：一個活動可以有多個訂單
-   SeatGroup → Seat：一個座位組可以有多個座位
-   Ticket → Seat：一個票種可以有多個座位
-   Order → OrderItem：一個訂單可以有多個訂單項目
-   Order → FormResponse：一個訂單可以有多個表單回應
-   CustomForm → CustomFormField：一個表單可以有多個欄位

### 多對一關聯

-   Ticket → Event：一個票種屬於一個活動
-   Ticket → SeatGroup：一個票種可能使用一個座位組
-   Seat → SeatGroup：一個座位可能屬於一個座位組
-   Seat → Ticket：一個座位屬於一個票種
-   OrderItem → Order：一個訂單項目屬於一個訂單
-   OrderItem → Ticket：一個訂單項目關聯一個票種
-   OrderItem → Seat：一個訂單項目可能關聯一個座位 (如適用)
-   CheckIn → OrderItem：一個簽到記錄關聯一個訂單項目
-   CustomFormField → CustomForm：一個欄位屬於一個表單
-   FormResponse → CustomFormField：一個回應關聯一個表單欄位
-   FormResponse → Order：一個回應屬於一個訂單

## 訂單狀態生命週期

### Order 狀態流程

-   `pending` → 初始狀態，訂單剛建立但尚未確認
-   `pending_payment` → 訂單已確認，等待付款
-   `paid` → 付款已完成
-   `completed` → 活動已結束，訂單完成
-   `cancelled` → 訂單被取消
-   `refunding` → 退款處理中
-   `refunded` → 已退款
-   `expired` → 訂單超時未付款，自動取消

### Payment 狀態流程

-   `unpaid` → 初始狀態，尚未付款
-   `pending` → 付款處理中
-   `paid` → 付款已完成
-   `failed` → 付款失敗
-   `refunded` → 已全額退款
-   `partially_refunded` → 部分退款

### OrderItem 狀態流程

-   `pending` → 初始狀態，待處理
-   `reserved` → 已預留但尚未付款確認
-   `paid` → 付款已完成，票券有效
-   `cancelled` → 票券已取消
-   `checked_in` → 已完成入場簽到
-   `refunded` → 已退款

## 索引設計

為提高查詢效能，建議為以下欄位建立索引：

1. `users` 表：

    - `email`（唯一索引，提高登入速度）
    - `provider`, `provider_id`（組合索引，提高第三方登入查詢速度）

2. `events` 表：

    - `slug`（唯一索引，提高 URL 查詢速度）
    - `status`, `start_at`（組合索引，提高活動篩選效能）

3. `tickets` 表：

    - `event_id`（外鍵索引）
    - `status`, `start_sale_at`, `end_sale_at`（組合索引，提高可售票券查詢效能）
    - `seat_group_id`（外鍵索引）

4. `seat_groups` 表：

    - 基本索引足夠

5. `seats` 表：

    - `ticket_id`（外鍵索引）
    - `seat_group_id`（外鍵索引）
    - `status`（索引，快速查找可用座位）
    - `ticket_id`, `row_name`, `seat_number`（唯一索引，確保座位唯一性）

6. `orders` 表：

    - `order_number`（唯一索引）
    - `user_id`（外鍵索引）
    - `event_id`（外鍵索引）
    - `status`, `created_at`（組合索引，提高訂單狀態查詢效能）
    - `payment_provider_order_id`（索引，提高第三方支付回調查詢速度）

7. `order_items` 表：

    - `order_id`（外鍵索引）
    - `ticket_id`（外鍵索引）
    - `seat_id`（外鍵索引）
    - `ticket_code`（唯一索引，提高票券查詢速度）
    - `status`（索引，快速查找特定狀態的票券）
    - `purchase_token`（唯一索引，防止高併發重複購買）
    - `ticket_id`, `seat_id`（唯一索引，確保座位不被重複售出）

8. `form_responses` 表：
    - `order_id`（外鍵索引）
    - `custom_form_field_id`（外鍵索引）

## Laravel 模型設計與關係

系統將利用 Laravel 的 Eloquent ORM 實現資料關聯和業務邏輯：

1. **使用 Laravel Traits**:

    - 所有模型使用 `SoftDeletes` 實現軟刪除
    - 使用 `HasFactory` 支援模型工廠測試
    - 使用 `Uuid` trait 實現 UUID 主鍵

2. **枚舉處理**:

    - 使用 Laravel 枚舉類型（PHP 8.1+）定義狀態和類型
    - 在模型中使用 `$casts` 屬性映射枚舉欄位

3. **使用 Laravel Sanctum**:
    - 用於 API 授權和令牌管理
    - 取代自定義 API 令牌方案

## 資料遷移與種子資料

### 建議的遷移順序

為了確保外鍵參照的完整性，建議按以下順序進行遷移：

1. `users`
2. `custom_forms`
3. `custom_form_fields`
4. `seat_groups`
5. `events`
6. `tickets`
7. `seats`
8. `orders`
9. `order_items`
10. `form_responses`
11. `check_ins`

### 基本種子資料

建議初始化以下種子資料：

1. 管理員用戶
2. 示範座位組（常用場地配置）
3. 示範活動
4. 示範票種及座位

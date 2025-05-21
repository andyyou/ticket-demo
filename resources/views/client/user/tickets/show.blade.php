<x-layouts.client>
    <x-slot name="title">票券詳情 - 藝文售票平台</x-slot>

    <!-- 頁頭區域 -->
    <div class="bg-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <a href="{{ route('user.tickets.index') }}" class="mr-4 text-zinc-600 hover:text-zinc-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-zinc-900 mb-1">票券詳情</h1>
                    <p class="text-zinc-600">票券編號：#TICKET-10001</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 主內容區域 -->
    <div class="py-12 bg-neutral-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- 左側票券詳情 -->
                <div class="w-full lg:w-2/3">
                    <!-- 票券卡片 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-8">
                        <div class="p-6 md:p-8">
                            <div class="flex flex-col md:flex-row md:items-start gap-6">
                                <div class="md:w-1/3">
                                    <div class="aspect-[3/4] bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <div class="text-center text-white p-4">
                                            <div class="text-sm font-medium mb-2">活動日期</div>
                                            <div class="text-4xl font-bold mb-1">01/15</div>
                                            <div class="text-xl mb-3">2025</div>
                                            <div class="text-sm">週三 19:30 - 21:30</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:w-2/3">
                                    <div class="mb-4">
                                        <h2 class="text-2xl font-bold text-zinc-900 mb-2">2025 台北春季音樂會</h2>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            音樂會
                                        </span>
                                    </div>
                                    
                                    <div class="text-zinc-600 space-y-2">
                                        <div class="flex items-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 text-zinc-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                            </svg>
                                            <div>
                                                <div class="font-medium text-zinc-900">台北國家音樂廳</div>
                                                <div class="text-sm">台北市中正區中山南路21-1號</div>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-zinc-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                            </svg>
                                            <span>全票</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-zinc-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                            </svg>
                                            <span>票券狀態：<span class="font-medium text-green-600">有效</span></span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 flex items-center">
                                        <a href="{{ route('events.show', 1) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            查看活動詳情
                                        </a>
                                        <button type="button" class="ml-3 inline-flex items-center px-4 py-2 border border-zinc-300 rounded-md shadow-sm text-sm font-medium text-zinc-700 bg-white hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            下載票券 PDF
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 入場 QR 碼 -->
                    <div class="bg-white rounded-lg shadow-sm p-6 md:p-8 mb-8">
                        <h2 class="text-xl font-bold text-zinc-900 mb-4 text-center">入場 QR 碼</h2>
                        
                        <div class="flex justify-center mb-6">
                            <!-- 這裡實際應用中應該是動態生成的QR碼 -->
                            <div class="w-64 h-64 bg-zinc-100 flex items-center justify-center border border-zinc-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                </svg>
                            </div>
                        </div>
                        
                        <div class="text-center mb-8">
                            <div class="text-zinc-900 font-mono font-medium mb-1">TICKET-10001-ABC123</div>
                            <div class="text-xs text-zinc-600">請在入場時出示此QR碼</div>
                        </div>
                        
                        <div class="flex justify-center space-x-3">
                            <button type="button" class="inline-flex items-center px-4 py-2 border border-zinc-300 rounded-md shadow-sm text-sm font-medium text-zinc-700 bg-white hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                儲存至手機
                            </button>
                            <button type="button" class="inline-flex items-center px-4 py-2 border border-zinc-300 rounded-md shadow-sm text-sm font-medium text-zinc-700 bg-white hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0v3H7V4h6zm-5 7a1 1 0 110-2 1 1 0 010 2zm3 0a1 1 0 110-2 1 1 0 010 2zm3 0a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd" />
                                </svg>
                                列印票券
                            </button>
                        </div>
                    </div>

                    <!-- 活動須知 -->
                    <div class="bg-white rounded-lg shadow-sm p-6 md:p-8">
                        <h2 class="text-xl font-bold text-zinc-900 mb-4">活動須知</h2>
                        
                        <div class="prose prose-zinc max-w-none">
                            <ul class="space-y-2">
                                <li>音樂會開始後，遲到觀眾需待中場休息時方可入場。</li>
                                <li>請勿攜帶食物或飲料進入音樂廳，演出期間請關閉手機及其他會發出聲響的裝置。</li>
                                <li>演出期間禁止拍照、錄影及錄音。</li>
                                <li>請於活動開始前30分鐘抵達會場，完成入場手續。</li>
                                <li>本票券不得轉售、不可退換。</li>
                                <li>若有任何問題，請聯繫客服：support@example.com</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 右側相關資訊 -->
                <div class="w-full lg:w-1/3">
                    <!-- 訂單資訊 -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                        <h2 class="text-lg font-medium text-zinc-900 mb-4">訂單資訊</h2>
                        
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-zinc-600">訂單編號</dt>
                                <dd class="mt-1 text-zinc-900">#ORD-2025010001</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-zinc-600">訂購日期</dt>
                                <dd class="mt-1 text-zinc-900">2025-01-01</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-zinc-600">付款方式</dt>
                                <dd class="mt-1 text-zinc-900">信用卡</dd>
                            </div>
                        </dl>
                        
                        <div class="mt-4">
                            <a href="{{ route('user.orders.show', 1) }}" class="text-sm font-medium text-purple-600 hover:text-purple-800 inline-flex items-center">
                                查看完整訂單
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- 購票人資訊 -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                        <h2 class="text-lg font-medium text-zinc-900 mb-4">購票人資訊</h2>
                        
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-zinc-600">姓名</dt>
                                <dd class="mt-1 text-zinc-900">陳大文</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-zinc-600">電子郵件</dt>
                                <dd class="mt-1 text-zinc-900">example@example.com</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-zinc-600">聯絡電話</dt>
                                <dd class="mt-1 text-zinc-900">0987-654-321</dd>
                            </div>
                        </dl>
                    </div>
                    
                    <!-- 交通資訊 -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-lg font-medium text-zinc-900 mb-4">交通資訊</h2>
                        
                        <!-- 地圖預覽 -->
                        <div class="aspect-[16/9] bg-zinc-200 rounded-lg overflow-hidden mb-4 flex items-center justify-center">
                            <span class="text-zinc-600">地圖載入中...</span>
                        </div>
                        
                        <h3 class="font-medium text-zinc-900 mb-2">台北國家音樂廳</h3>
                        <p class="text-zinc-600 mb-4">台北市中正區中山南路21-1號</p>
                        
                        <div class="space-y-2">
                            <div>
                                <h4 class="text-sm font-medium text-zinc-900">大眾運輸</h4>
                                <p class="text-sm text-zinc-600">搭乘捷運：中正紀念堂站下車，步行約8分鐘可抵達。</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-zinc-900">自行開車</h4>
                                <p class="text-sm text-zinc-600">可停放於國家音樂廳地下停車場，或周邊公共停車場。</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <a href="https://maps.google.com/?q=台北國家音樂廳" target="_blank" class="text-sm font-medium text-purple-600 hover:text-purple-800 inline-flex items-center">
                                在 Google 地圖中查看
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                    <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.client> 
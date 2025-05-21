<x-layouts.client>
    <x-slot name="title">訂單詳情 - 藝文售票平台</x-slot>

    <!-- 頁頭區域 -->
    <div class="bg-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <a href="{{ route('user.orders.index') }}" class="mr-4 text-zinc-600 hover:text-zinc-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-zinc-900 mb-1">訂單詳情</h1>
                    <p class="text-zinc-600">訂單編號：#ORD-2025010001</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 主內容區域 -->
    <div class="py-12 bg-neutral-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- 左側訂單詳情 -->
                <div class="w-full lg:w-2/3">
                    <!-- 訂單狀態卡片 -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-medium text-zinc-900">訂單狀態</h2>
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                已付款
                            </span>
                        </div>
                        
                        <div class="mt-6">
                            <div class="relative">
                                <div class="overflow-hidden h-2 flex rounded bg-zinc-200">
                                    <div class="w-full bg-green-500"></div>
                                </div>
                                <div class="flex justify-between text-xs text-zinc-600 mt-2">
                                    <div class="w-1/4 text-left">
                                        <div class="font-medium text-green-600">訂單建立</div>
                                        <div>2025-01-01 10:15</div>
                                    </div>
                                    <div class="w-1/4 text-center">
                                        <div class="font-medium text-green-600">付款完成</div>
                                        <div>2025-01-01 10:20</div>
                                    </div>
                                    <div class="w-1/4 text-center">
                                        <div class="font-medium text-green-600">票券發送</div>
                                        <div>2025-01-01 10:21</div>
                                    </div>
                                    <div class="w-1/4 text-right">
                                        <div class="font-medium text-green-600">訂單完成</div>
                                        <div>2025-01-01 10:21</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 活動資訊卡片 -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                        <h2 class="text-xl font-medium text-zinc-900 mb-4">活動資訊</h2>
                        
                        <div class="flex items-start">
                            <div class="w-24 h-24 flex-shrink-0 rounded-lg overflow-hidden bg-gradient-to-r from-blue-500 to-purple-600 mr-4"></div>
                            <div>
                                <h3 class="font-bold text-lg text-zinc-900 mb-1">2025 台北春季音樂會</h3>
                                <div class="text-zinc-600 space-y-1">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                        <span>2025-01-15 19:30 - 21:30</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        <span>台北國家音樂廳 (台北市中正區中山南路21-1號)</span>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <a href="{{ route('events.show', 1) }}" class="text-sm font-medium text-purple-600 hover:text-purple-800 inline-flex items-center">
                                        查看活動詳情
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 票券資訊卡片 -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                        <h2 class="text-xl font-medium text-zinc-900 mb-4">票券資訊</h2>

                        <div class="overflow-hidden border border-zinc-200 rounded-lg divide-y divide-zinc-200">
                            <!-- 票券 1 -->
                            <div class="p-4">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div class="mb-2 md:mb-0">
                                        <h3 class="font-medium text-zinc-900">全票 x 2</h3>
                                        <p class="text-sm text-zinc-600">NT$ 500 / 張</p>
                                    </div>
                                    <div class="text-zinc-900 font-medium">
                                        NT$ 1,000
                                    </div>
                                </div>
                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-zinc-300 rounded-md shadow-sm text-sm font-medium text-zinc-700 bg-white hover:bg-zinc-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd" />
                                        </svg>
                                        查看票券 #1
                                    </a>
                                    <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-zinc-300 rounded-md shadow-sm text-sm font-medium text-zinc-700 bg-white hover:bg-zinc-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd" />
                                        </svg>
                                        查看票券 #2
                                    </a>
                                </div>
                            </div>

                            <!-- 票券 2 -->
                            <div class="p-4">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div class="mb-2 md:mb-0">
                                        <h3 class="font-medium text-zinc-900">學生票 x 1</h3>
                                        <p class="text-sm text-zinc-600">NT$ 300 / 張</p>
                                    </div>
                                    <div class="text-zinc-900 font-medium">
                                        NT$ 300
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-zinc-300 rounded-md shadow-sm text-sm font-medium text-zinc-700 bg-white hover:bg-zinc-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd" />
                                        </svg>
                                        查看票券 #3
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 客製化表單回應卡片 -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-medium text-zinc-900 mb-4">表單回應</h2>
                        
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-4">
                            <div>
                                <dt class="text-sm font-medium text-zinc-600">緊急聯絡人</dt>
                                <dd class="mt-1 text-zinc-900">王小明</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-zinc-600">緊急聯絡人電話</dt>
                                <dd class="mt-1 text-zinc-900">0912-345-678</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-zinc-600">飲食偏好</dt>
                                <dd class="mt-1 text-zinc-900">葷食</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- 右側訂單摘要 -->
                <div class="w-full lg:w-1/3">
                    <!-- 購票人資訊卡片 -->
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
                    
                    <!-- 付款資訊卡片 -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                        <h2 class="text-lg font-medium text-zinc-900 mb-4">付款資訊</h2>
                        
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-zinc-600">付款方式</dt>
                                <dd class="mt-1 text-zinc-900">信用卡</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-zinc-600">付款時間</dt>
                                <dd class="mt-1 text-zinc-900">2025-01-01 10:20</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-zinc-600">交易編號</dt>
                                <dd class="mt-1 text-zinc-900">TXN12345678901234</dd>
                            </div>
                        </dl>
                    </div>
                    
                    <!-- 訂單摘要卡片 -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-lg font-medium text-zinc-900 mb-4">訂單摘要</h2>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-zinc-600">全票 (NT$ 500 x 2)</span>
                                <span class="text-zinc-900">NT$ 1,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-600">學生票 (NT$ 300 x 1)</span>
                                <span class="text-zinc-900">NT$ 300</span>
                            </div>
                            <div class="border-t border-zinc-200 pt-3 flex justify-between font-medium">
                                <span class="text-zinc-800">總金額</span>
                                <span class="text-zinc-900">NT$ 1,300</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 space-y-3">
                            <a href="{{ route('user.tickets.index') }}" class="block w-full px-4 py-2 bg-purple-600 border border-transparent rounded-md font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                查看我的票券
                            </a>
                            <button type="button" class="block w-full px-4 py-2 bg-white border border-zinc-300 rounded-md font-medium text-zinc-700 hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 text-center">
                                下載電子發票
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.client> 
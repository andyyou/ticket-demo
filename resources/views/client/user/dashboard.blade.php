<x-layouts.client>
    <x-slot name="title">我的帳戶 - 藝文售票平台</x-slot>

    <!-- 頁頭區域 -->
    <div class="bg-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-zinc-900 mb-2">我的帳戶</h1>
            <p class="text-zinc-600">管理您的訂單、票券和個人資料</p>
        </div>
    </div>

    <!-- 主內容區域 -->
    <div class="py-12 bg-neutral-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- 使用者資訊概覽 -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center gap-6">
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-purple-100">
                            <span class="text-xl font-medium text-purple-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-zinc-900 mb-1">{{ Auth::user()->name }}</h2>
                        <p class="text-zinc-600">{{ Auth::user()->email }}</p>
                        <div class="mt-2">
                            <a href="{{ route('settings.profile') }}" class="text-sm font-medium text-purple-600 hover:text-purple-800">
                                編輯個人資料
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 統計卡片 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- 待參加活動 -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-zinc-500 mb-1">待參加活動</p>
                            <h3 class="text-3xl font-bold text-zinc-900">2</h3>
                        </div>
                        <div class="bg-purple-100 rounded-full p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('user.tickets.index') }}" class="text-sm font-medium text-purple-600 hover:text-purple-800 flex items-center">
                            查看我的票券
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- 已完成訂單 -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-zinc-500 mb-1">已完成訂單</p>
                            <h3 class="text-3xl font-bold text-zinc-900">5</h3>
                        </div>
                        <div class="bg-green-100 rounded-full p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('user.orders.index') }}" class="text-sm font-medium text-purple-600 hover:text-purple-800 flex items-center">
                            查看我的訂單
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- 待處理訂單 -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-zinc-500 mb-1">待處理訂單</p>
                            <h3 class="text-3xl font-bold text-zinc-900">0</h3>
                        </div>
                        <div class="bg-yellow-100 rounded-full p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('user.orders.index') }}?status=pending" class="text-sm font-medium text-purple-600 hover:text-purple-800 flex items-center">
                            查看待處理訂單
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 最近訂單 -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-6 border-b border-zinc-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-medium text-zinc-900">最近訂單</h2>
                        <a href="{{ route('user.orders.index') }}" class="text-sm font-medium text-purple-600 hover:text-purple-800">
                            查看全部
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-zinc-200">
                        <thead class="bg-zinc-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">訂單編號</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">活動</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">訂購日期</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">金額</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">狀態</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase tracking-wider">操作</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">#ORD-2025010001</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">2025 台北春季音樂會</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">2025-01-01</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">NT$ 1,300</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        已付款
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('user.orders.show', 1) }}" class="text-purple-600 hover:text-purple-800">查看詳情</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">#ORD-2024120015</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">現代舞蹈：城市之聲</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">2024-12-15</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">NT$ 800</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        已付款
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('user.orders.show', 2) }}" class="text-purple-600 hover:text-purple-800">查看詳情</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.client> 
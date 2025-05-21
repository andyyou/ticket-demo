<x-layouts.client>
    <x-slot name="title">我的訂單 - 藝文售票平台</x-slot>

    <!-- 頁頭區域 -->
    <div class="bg-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-zinc-900 mb-2">我的訂單</h1>
            <p class="text-zinc-600">查看和管理您的所有購票訂單</p>
        </div>
    </div>

    <!-- 主內容區域 -->
    <div class="py-12 bg-neutral-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- 篩選工具列 -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <form action="{{ route('user.orders.index') }}" method="get">
                    <div class="flex flex-col md:flex-row md:items-end space-y-4 md:space-y-0 md:space-x-4">
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-zinc-700 mb-1">搜尋訂單</label>
                            <input type="text" id="search" name="search" placeholder="訂單編號或活動名稱" class="block w-full px-4 py-2 border border-zinc-300 rounded-md bg-white text-zinc-900 shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-zinc-700 mb-1">訂單狀態</label>
                            <select id="status" name="status" class="block w-full px-4 py-2 border border-zinc-300 rounded-md bg-white text-zinc-900 shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">所有狀態</option>
                                <option value="paid">已付款</option>
                                <option value="pending">待付款</option>
                                <option value="cancelled">已取消</option>
                                <option value="refunded">已退款</option>
                            </select>
                        </div>
                        <div>
                            <label for="date_range" class="block text-sm font-medium text-zinc-700 mb-1">時間範圍</label>
                            <select id="date_range" name="date_range" class="block w-full px-4 py-2 border border-zinc-300 rounded-md bg-white text-zinc-900 shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">所有時間</option>
                                <option value="1m">最近一個月</option>
                                <option value="3m">最近三個月</option>
                                <option value="6m">最近半年</option>
                                <option value="1y">最近一年</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                篩選訂單
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- 訂單列表 -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-zinc-200">
                        <thead class="bg-zinc-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">訂單編號</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">活動</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">訂購日期</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">活動日期</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">金額</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">狀態</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase tracking-wider">操作</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-200">
                            <!-- 訂單 1 -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">#ORD-2025010001</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">2025 台北春季音樂會</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">2025-01-01</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">2025-01-15 19:30</td>
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

                            <!-- 訂單 2 -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">#ORD-2024120015</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">現代舞蹈：城市之聲</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">2024-12-15</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">2025-03-10 19:00</td>
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

                            <!-- 訂單 3 -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">#ORD-2024120010</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">幕後的秘密：展演藝術工作坊</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">2024-12-10</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">2025-02-20 14:00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">NT$ 600</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        已付款
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('user.orders.show', 3) }}" class="text-purple-600 hover:text-purple-800">查看詳情</a>
                                </td>
                            </tr>

                            <!-- 訂單 4 -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">#ORD-2024110023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">爵士之夜：即興與創新</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">2024-11-23</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">2024-12-05 19:30</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">NT$ 900</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        已退款
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('user.orders.show', 4) }}" class="text-purple-600 hover:text-purple-800">查看詳情</a>
                                </td>
                            </tr>

                            <!-- 訂單 5 -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">#ORD-2024110015</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">影像的力量：攝影藝術展</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">2024-11-15</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">2024-11-20 10:00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900">NT$ 500</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        已付款
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('user.orders.show', 5) }}" class="text-purple-600 hover:text-purple-800">查看詳情</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- 分頁導航 -->
                <div class="bg-white px-6 py-4 border-t border-zinc-200">
                    <nav class="flex justify-between">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-zinc-300 text-sm font-medium rounded-md text-zinc-700 bg-white hover:bg-zinc-50">
                                上一頁
                            </a>
                            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-zinc-300 text-sm font-medium rounded-md text-zinc-700 bg-white hover:bg-zinc-50">
                                下一頁
                            </a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-zinc-700">
                                    顯示第 <span class="font-medium">1</span> 至 <span class="font-medium">5</span> 筆，共 <span class="font-medium">12</span> 筆結果
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-zinc-300 bg-white text-sm font-medium text-zinc-500 hover:bg-zinc-50">
                                        <span class="sr-only">上一頁</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="#" aria-current="page" class="z-10 bg-purple-50 border-purple-500 text-purple-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        1
                                    </a>
                                    <a href="#" class="bg-white border-zinc-300 text-zinc-500 hover:bg-zinc-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        2
                                    </a>
                                    <a href="#" class="bg-white border-zinc-300 text-zinc-500 hover:bg-zinc-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        3
                                    </a>
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-zinc-300 bg-white text-sm font-medium text-zinc-500 hover:bg-zinc-50">
                                        <span class="sr-only">下一頁</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</x-layouts.client> 
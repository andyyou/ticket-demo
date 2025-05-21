<x-layouts.client>
    <x-slot name="title">我的票券 - 藝文售票平台</x-slot>

    <!-- 頁頭區域 -->
    <div class="bg-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-zinc-900 mb-2">我的票券</h1>
            <p class="text-zinc-600">查看您即將參加的活動票券</p>
        </div>
    </div>

    <!-- 主內容區域 -->
    <div class="py-12 bg-neutral-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- 篩選工具列 -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <form action="{{ route('user.tickets.index') }}" method="get">
                    <div class="flex flex-col md:flex-row md:items-end space-y-4 md:space-y-0 md:space-x-4">
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-zinc-700 mb-1">搜尋活動</label>
                            <input type="text" id="search" name="search" placeholder="活動名稱或地點" class="block w-full px-4 py-2 border border-zinc-300 rounded-md bg-white text-zinc-900 shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label for="date_range" class="block text-sm font-medium text-zinc-700 mb-1">時間範圍</label>
                            <select id="date_range" name="date_range" class="block w-full px-4 py-2 border border-zinc-300 rounded-md bg-white text-zinc-900 shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">所有時間</option>
                                <option value="1w">一週內</option>
                                <option value="1m">一個月內</option>
                                <option value="3m">三個月內</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                篩選票券
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
                <!-- 票券卡片 1 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="md:flex">
                        <div class="md:flex-shrink-0 w-full md:w-1/4">
                            <div class="h-48 md:h-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                <div class="text-center text-white p-4">
                                    <div class="text-sm font-medium">活動日期</div>
                                    <div class="text-2xl font-bold mb-1">01/15</div>
                                    <div class="text-sm">2025 週三 19:30</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 md:p-8 md:flex-1">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div class="mb-4 md:mb-0">
                                    <h2 class="text-xl font-bold text-zinc-900 mb-1">2025 台北春季音樂會</h2>
                                    <div class="text-zinc-600 space-y-1">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                            </svg>
                                            <span>台北國家音樂廳</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                            </svg>
                                            <span>訂單 #ORD-2025010001</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col items-start md:items-end">
                                    <div class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-medium mb-3">
                                        即將到來
                                    </div>
                                    <div class="space-y-2">
                                        <div class="text-sm text-zinc-600">
                                            <span class="font-medium text-zinc-900">3</span> 張票券
                                        </div>
                                        <div>
                                            <a href="{{ route('user.tickets.show', 1) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                                查看票券
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 票券卡片 2 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="md:flex">
                        <div class="md:flex-shrink-0 w-full md:w-1/4">
                            <div class="h-48 md:h-full bg-gradient-to-r from-green-500 to-teal-600 flex items-center justify-center">
                                <div class="text-center text-white p-4">
                                    <div class="text-sm font-medium">活動日期</div>
                                    <div class="text-2xl font-bold mb-1">02/20</div>
                                    <div class="text-sm">2025 週四 14:00</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 md:p-8 md:flex-1">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div class="mb-4 md:mb-0">
                                    <h2 class="text-xl font-bold text-zinc-900 mb-1">幕後的秘密：展演藝術工作坊</h2>
                                    <div class="text-zinc-600 space-y-1">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                            </svg>
                                            <span>台北藝術中心</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                            </svg>
                                            <span>訂單 #ORD-2024120010</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col items-start md:items-end">
                                    <div class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-medium mb-3">
                                        即將到來
                                    </div>
                                    <div class="space-y-2">
                                        <div class="text-sm text-zinc-600">
                                            <span class="font-medium text-zinc-900">2</span> 張票券
                                        </div>
                                        <div>
                                            <a href="{{ route('user.tickets.show', 2) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                                查看票券
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 票券卡片 3 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="md:flex">
                        <div class="md:flex-shrink-0 w-full md:w-1/4">
                            <div class="h-48 md:h-full bg-gradient-to-r from-yellow-500 to-orange-600 flex items-center justify-center">
                                <div class="text-center text-white p-4">
                                    <div class="text-sm font-medium">活動日期</div>
                                    <div class="text-2xl font-bold mb-1">03/10</div>
                                    <div class="text-sm">2025 週一 19:00</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 md:p-8 md:flex-1">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div class="mb-4 md:mb-0">
                                    <h2 class="text-xl font-bold text-zinc-900 mb-1">現代舞蹈：城市之聲</h2>
                                    <div class="text-zinc-600 space-y-1">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                            </svg>
                                            <span>台北市立劇場</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                            </svg>
                                            <span>訂單 #ORD-2024120015</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col items-start md:items-end">
                                    <div class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-medium mb-3">
                                        即將到來
                                    </div>
                                    <div class="space-y-2">
                                        <div class="text-sm text-zinc-600">
                                            <span class="font-medium text-zinc-900">2</span> 張票券
                                        </div>
                                        <div>
                                            <a href="{{ route('user.tickets.show', 3) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                                查看票券
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.client> 
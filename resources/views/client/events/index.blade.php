<x-layouts.client>
    <x-slot name="title">活動列表 - 藝文活動網</x-slot>

    <!-- 頁頭區域 -->
    <div class="bg-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-zinc-900 mb-2">探索藝文活動</h1>
            <p class="text-zinc-600">尋找並參與精彩的藝文活動，豐富您的文化生活</p>
        </div>
    </div>

    <!-- 活動分類快速選項 -->
    <div class="bg-white border-b border-zinc-200">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex overflow-x-auto py-4 whitespace-nowrap -mx-2">
                <a href="{{ route('events.index') }}" class="mx-2 px-4 py-2 text-sm font-medium rounded-full {{ !request()->has('type') ? 'bg-purple-100 text-purple-800' : 'text-zinc-600 hover:bg-zinc-100' }}">
                    全部活動
                </a>
                @foreach($typeNames as $typeKey => $typeName)
                    <a href="{{ route('events.byType', $typeKey) }}" class="mx-2 px-4 py-2 text-sm font-medium rounded-full {{ request('type') === $typeKey ? 'bg-purple-100 text-purple-800' : 'text-zinc-600 hover:bg-zinc-100' }}">
                        {{ $typeName }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- 主內容區域 -->
    <div class="py-12 bg-neutral-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- 篩選側邊欄 -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white rounded-lg shadow-sm p-6 sticky top-8">
                        <h2 class="text-lg font-medium text-zinc-900 mb-4">篩選條件</h2>
                        
                        <form action="{{ route('events.index') }}" method="GET">
                            <!-- 搜尋框 -->
                            <div class="mb-6">
                                <label for="search" class="block text-sm font-medium text-zinc-700 mb-1">關鍵字搜尋</label>
                                <div class="relative">
                                    <input type="text" id="search" name="search" value="{{ request('search') }}" class="block w-full px-4 py-2 border border-zinc-300 rounded-md bg-white text-zinc-900 shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500" placeholder="搜尋活動、地點或演出者">
                                    <button type="submit" class="absolute inset-y-0 right-0 px-3 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-zinc-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- 活動類型篩選 -->
                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-zinc-700 mb-2">活動類型</h3>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <input id="type-all" name="type" value="" type="radio" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-zinc-300" {{ request('type') ? '' : 'checked' }}>
                                        <label for="type-all" class="ml-2 block text-sm text-zinc-600">所有類型</label>
                                    </div>
                                    @foreach($typeNames as $typeKey => $typeName)
                                        <div class="flex items-center">
                                            <input id="type-{{ $typeKey }}" name="type" value="{{ $typeKey }}" type="radio" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-zinc-300" {{ request('type') === $typeKey ? 'checked' : '' }}>
                                            <label for="type-{{ $typeKey }}" class="ml-2 block text-sm text-zinc-600">{{ $typeName }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- 套用篩選按鈕 -->
                            <button type="submit" class="w-full bg-purple-600 text-white px-4 py-2 rounded-md font-medium hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                                套用篩選
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- 活動列表區域 -->
                <div class="w-full lg:w-3/4">
                    <!-- 排序選項 -->
                    <div class="flex justify-between items-center mb-6">
                        <div class="text-sm text-zinc-600">
                            顯示 <span class="font-medium">{{ $events->total() }}</span> 個活動結果
                        </div>
                    </div>
                    
                    <!-- 活動網格 -->
                    @if($events->isEmpty())
                        <div class="text-center py-16">
                            <h2 class="text-xl font-medium text-zinc-900 mb-2">沒有找到符合條件的活動</h2>
                            <p class="text-zinc-600">請嘗試更改搜尋條件或瀏覽所有活動。</p>
                            <a href="{{ route('events.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-md font-medium hover:bg-purple-700">
                                查看所有活動
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($events as $event)
                                <div class="bg-white rounded-lg shadow-sm overflow-hidden h-full flex flex-col">
                                    <div class="aspect-[16/9] overflow-hidden">
                                        @if($event->featured_image_url)
                                            <img src="{{ $event->featured_image_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-purple-500 to-indigo-600"></div>
                                        @endif
                                    </div>
                                    <div class="p-6 flex flex-col flex-grow">
                                        <!-- Card Body -->
                                        <div class="flex-grow">
                                            <div class="flex items-center mb-2 text-xs sm:text-sm text-zinc-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="truncate">{{ $event->start_at->format('Y-m-d H:i') }}</span>
                                            </div>
                                            
                                            <h3 class="font-semibold text-base sm:text-lg mb-2 text-zinc-900 line-clamp-2">
                                                <a href="{{ route('events.show', $event->id) }}" class="hover:text-purple-700">
                                                    {{ $event->title }}
                                                </a>
                                            </h3>
                                            
                                            <p class="text-zinc-600 text-xs sm:text-sm mb-3 md:mb-4 line-clamp-2">
                                                {{ $event->subtitle ?? Str::limit($event->description, 100) }}
                                            </p>
                                        </div>
                                        
                                        <!-- Card Footer -->
                                        <div class="pt-4 mt-auto border-t border-zinc-100">
                                            <div class="flex justify-between items-center">
                                                <span class="text-zinc-900 font-medium text-xs md:text-base">
                                                    @if($event->tickets->isNotEmpty())
                                                        NT${{ (int)$event->tickets->min('price') }}起
                                                    @else
                                                        尚未開放
                                                    @endif
                                                </span>
                                                <a href="{{ route('events.show', $event->id) }}" class="inline-flex items-center text-xs sm:text-sm font-medium text-purple-600 hover:text-purple-800">
                                                    了解更多
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    
                        <!-- 分頁導航 -->
                        <div class="mt-10">
                            {{ $events->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.client> 
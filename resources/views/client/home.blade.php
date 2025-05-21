<x-layouts.client>
    <x-slot name="title">首頁 - 藝文活動網</x-slot>

    <!-- 焦點活動輪播 -->
    <div class="bg-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 aspect-[21/9]">
                @if($featuredEvent)
                    <div class="absolute inset-0 w-full h-full">
                        @if($featuredEvent->featured_image_url)
                            <img src="{{ $featuredEvent->featured_image_url }}" alt="{{ $featuredEvent->title }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black opacity-30"></div>
                        @endif
                    </div>
                    <div class="absolute inset-0 p-6 md:p-8 flex flex-col justify-end text-white">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 backdrop-blur-sm mb-2 md:mb-4 w-fit">
                            精選活動
                        </span>
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold mb-1 md:mb-2 line-clamp-2">{{ $featuredEvent->title }}</h2>
                        <p class="text-sm sm:text-base md:text-lg mb-3 md:mb-4 max-w-2xl line-clamp-2">{{ $featuredEvent->subtitle ?? Str::limit($featuredEvent->description, 100) }}</p>
                        <a href="{{ route('events.show', $featuredEvent->id) }}" class="inline-flex items-center px-4 py-2 bg-white text-purple-600 rounded-md font-medium hover:bg-zinc-100 w-fit text-sm md:text-base">
                            了解詳情
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                @else
                    <div class="absolute inset-0 flex items-center justify-center text-white">
                        <div class="text-center px-4">
                            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold mb-2">即將推出精彩活動</h2>
                            <p class="text-white/80 mb-4">敬請期待我們即將推出的精彩藝文活動</p>
                            <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-purple-600 rounded-md font-medium hover:bg-zinc-100">
                                瀏覽所有活動
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- 最新活動區 -->
    <div class="py-8 md:py-12 bg-neutral-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6 md:mb-8">
                <h2 class="text-xl md:text-2xl font-bold text-zinc-900">最新活動</h2>
                <a href="{{ route('events.index') }}" class="text-sm font-medium text-zinc-600 hover:text-zinc-800 flex items-center">
                    查看全部
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>

            @if($latestEvents->isEmpty())
                <div class="text-center py-12">
                    <h3 class="text-lg font-medium text-zinc-900 mb-2">目前沒有活動</h3>
                    <p class="text-zinc-600 mb-4">敬請期待即將推出的精彩活動。</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                    @foreach($latestEvents as $event)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden h-full flex flex-col">
                            <div class="aspect-[16/9] overflow-hidden">
                                @if($event->featured_image_url)
                                    <img src="{{ $event->featured_image_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br 
                                        @if($loop->index % 6 === 0) from-blue-500 to-purple-600
                                        @elseif($loop->index % 6 === 1) from-yellow-500 to-orange-600
                                        @elseif($loop->index % 6 === 2) from-green-500 to-teal-600
                                        @elseif($loop->index % 6 === 3) from-red-500 to-pink-600
                                        @elseif($loop->index % 6 === 4) from-indigo-500 to-blue-600
                                        @else from-purple-500 to-violet-600
                                        @endif
                                    "></div>
                                @endif
                            </div>
                            <div class="p-4 md:p-6 flex flex-col flex-grow">
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
                                                即將開放
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
            @endif
        </div>
    </div>

    <!-- 活動分類區 -->
    <div class="py-8 md:py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl md:text-2xl font-bold text-zinc-900 mb-6 md:mb-8">瀏覽活動分類</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
                @foreach($typeNames as $typeKey => $typeName)
                    <a href="{{ route('events.byType', $typeKey) }}" class="group block bg-neutral-100 rounded-lg overflow-hidden hover:bg-neutral-200 transition">
                        <div class="aspect-square flex items-center justify-center p-4 md:p-6">
                            <div class="text-center">
                                <div class="flex justify-center mb-3 md:mb-4">
                                    @if($typeKey === 'concert')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-12 md:w-12 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z" />
                                        </svg>
                                    @elseif($typeKey === 'drama')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-12 md:w-12 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm3 2h6v4H7V5zm8 8v2h1v-2h-1zm-2-6H7v2h6V7zm0 4H7v2h6v-2zm-8 4h1v-2H5v2zm0-4h1v-2H5v2z" clip-rule="evenodd" />
                                        </svg>
                                    @elseif($typeKey === 'exhibition')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-12 md:w-12 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                        </svg>
                                    @elseif($typeKey === 'dance')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-12 md:w-12 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                        </svg>
                                    @elseif($typeKey === 'workshop')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-12 md:w-12 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                        </svg>
                                    @elseif($typeKey === 'lecture')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-12 md:w-12 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                        </svg>
                                    @elseif($typeKey === 'festival')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-12 md:w-12 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-12 md:w-12 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                                <h3 class="font-medium text-base md:text-lg text-zinc-900">{{ $typeName }}</h3>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- 訂閱區 -->
    <div class="py-8 md:py-12 bg-neutral-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl p-6 md:p-12">
                <div class="max-w-2xl mx-auto text-center">
                    <h2 class="text-xl md:text-2xl font-bold text-white mb-2 md:mb-4">獲取最新活動資訊</h2>
                    <p class="text-white/80 mb-4 md:mb-6 text-sm md:text-base">訂閱我們的電子報，第一時間接收新活動通知和獨家優惠。</p>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    @endif
                    
                    @if(session('info'))
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4" role="alert">
                            <p class="text-sm">{{ session('info') }}</p>
                        </div>
                    @endif
                    
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row max-w-md mx-auto gap-3">
                        @csrf
                        <input type="email" name="email" placeholder="您的電子郵件" class="flex-1 px-4 py-2 rounded-md border-0 focus:ring-2 focus:ring-white" required>
                        <button type="submit" class="bg-white text-purple-600 px-4 py-2 rounded-md font-medium hover:bg-zinc-100">
                            訂閱
                        </button>
                    </form>
                    
                    @error('email', 'newsletter')
                        <p class="mt-2 text-xs text-red-200">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</x-layouts.client> 
<x-layouts.client>
    <x-slot name="title">{{ $event->title }} - 藝文活動網</x-slot>

    <!-- 活動封面圖 -->
    <div class="relative w-full h-64 sm:h-80 md:h-96 lg:h-[400px] xl:h-[450px] overflow-hidden bg-violet-600">
        @if($event->featured_image_url)
            <div class="absolute inset-0 w-full h-full">
                <img src="{{ $event->featured_image_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black opacity-30"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-purple-600 to-indigo-800"></div>
        @endif

        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-white">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">{{ $event->title }}</h1>
                @if($event->subtitle)
                    <p class="text-xl md:text-2xl text-white/90">{{ $event->subtitle }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- 活動詳情 -->
    <div class="bg-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:space-x-10">
                <!-- 左側詳情區 -->
                <div class="w-full md:w-2/3 lg:w-3/4">
                    <!-- 標籤區 -->
                    <div class="flex flex-wrap gap-2 mb-8">
                        @if($event->type)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                                {{ $event->type_name }}
                            </span>
                        @endif
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                            {{ $event->start_at->format('Y-m-d H:i') }}
                        </span>
                    </div>

                    <!-- 活動描述 -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold mb-4 text-zinc-900">活動介紹</h2>
                        <div class="prose prose-lg max-w-none">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>

                    <!-- 活動地點 -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold mb-4 text-zinc-900">活動地點</h2>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-zinc-500 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h3 class="text-lg font-medium text-zinc-900">{{ $event->venue_name }}</h3>
                                <p class="text-zinc-600">{{ $event->venue_address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- 活動時間 -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold mb-4 text-zinc-900">活動時間</h2>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-zinc-500 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-zinc-900">
                                    開始時間：{{ $event->start_at->format('Y-m-d H:i') }}
                                </p>
                                <p class="text-zinc-900">
                                    結束時間：{{ $event->end_at->format('Y-m-d H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 主辦單位 -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold mb-4 text-zinc-900">主辦單位</h2>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-zinc-500 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                            <div>
                                <p class="text-zinc-900">{{ $event->organizer }}</p>
                            </div>
                        </div>
                    </div>

                    @if($event->notes)
                    <!-- 備註事項 -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold mb-4 text-zinc-900">備註事項</h2>
                        <div class="bg-amber-50 border-l-4 border-amber-500 p-4">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-amber-700">
                                    {!! nl2br(e($event->notes)) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($event->refund_policy)
                    <!-- 退款政策 -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold mb-4 text-zinc-900">退款政策</h2>
                        <div class="bg-zinc-50 border border-zinc-200 rounded-lg p-4">
                            <p class="text-zinc-700">
                                {!! nl2br(e($event->refund_policy)) !!}
                            </p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- 右側票券資訊 -->
                <div class="w-full md:w-1/3 lg:w-1/4 mt-10 md:mt-0">
                    <div class="bg-zinc-50 rounded-lg shadow-sm p-6 sticky top-8">
                        <h2 class="text-xl font-bold mb-4 text-zinc-900">票券資訊</h2>
                        
                        @if($event->tickets->isEmpty())
                            <div class="py-4 text-center">
                                <p class="text-zinc-600">尚未開放售票</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($event->tickets as $ticket)
                                    <div class="border-b border-zinc-200 pb-4 last:border-b-0 last:pb-0">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="font-medium text-zinc-900">{{ $ticket->name }}</h3>
                                                <p class="text-sm text-zinc-600">{{ $ticket->description }}</p>
                                                <p class="mt-1 text-zinc-900 font-bold">NT$ {{ $ticket->price }}</p>
                                                
                                                @if($ticket->ticket_type === 'default')
                                                    <p class="text-sm text-zinc-500 mt-1">
                                                        剩餘 {{ $ticket->quantity - $ticket->quantity_sold }} 張
                                                    </p>
                                                @endif
                                            </div>
                                            
                                            @if($event->isActive())
                                                <div>
                                                    <a href="{{ route('checkout') }}?ticket={{ $ticket->id }}" class="inline-flex items-center justify-center px-4 py-2 bg-purple-600 text-white rounded-md text-sm font-medium hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                                        購票
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        
                        <div class="mt-6">
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-zinc-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-medium text-zinc-900">安全交易保障</span>
                            </div>
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-zinc-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-medium text-zinc-900">電子票券立即發送</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-zinc-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-medium text-zinc-900">7x24 客服支援</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-zinc-200">
                            <a href="{{ route('events.index') }}" class="inline-flex items-center text-sm font-medium text-purple-600 hover:text-purple-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                瀏覽更多活動
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.client> 
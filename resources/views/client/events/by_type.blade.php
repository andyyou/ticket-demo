<x-layouts.client>
    <x-slot name="title">{{ $typeName }} - 藝文活動網</x-slot>

    <!-- 頁面標題區 -->
    <div class="bg-purple-700 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h1 class="text-3xl font-bold">{{ $typeName }}</h1>
            <p class="mt-2 text-lg text-purple-100">探索最新的{{ $typeName }}活動</p>
        </div>
    </div>

    <!-- 活動分類過濾區 -->
    <div class="bg-white border-b border-zinc-200">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex overflow-x-auto py-4 whitespace-nowrap -mx-2">
                <a href="{{ route('events.index') }}" class="mx-2 px-4 py-2 text-sm font-medium rounded-full {{ !request()->has('type') ? 'bg-purple-100 text-purple-800' : 'text-zinc-600 hover:bg-zinc-100' }}">
                    全部活動
                </a>
                @foreach($typeNames as $typeKey => $typeName)
                    <a href="{{ route('events.byType', $typeKey) }}" class="mx-2 px-4 py-2 text-sm font-medium rounded-full {{ $type === $typeKey ? 'bg-purple-100 text-purple-800' : 'text-zinc-600 hover:bg-zinc-100' }}">
                        {{ $typeName }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- 活動列表 -->
    <div class="py-12 bg-neutral-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @if($events->isEmpty())
                <div class="text-center py-16">
                    <h2 class="text-xl font-medium text-zinc-900 mb-2">目前沒有{{ $typeName }}活動</h2>
                    <p class="text-zinc-600">請稍後再查看，或瀏覽其他類型的活動。</p>
                    <a href="{{ route('events.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-md font-medium hover:bg-purple-700">
                        查看所有活動
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($events as $event)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="aspect-[16/9] overflow-hidden">
                                @if($event->featured_image_url)
                                    <img src="{{ $event->featured_image_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-purple-500 to-indigo-600"></div>
                                @endif
                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-2 text-sm text-zinc-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $event->start_at->format('Y-m-d H:i') }}
                                </div>
                                <h3 class="font-semibold text-lg mb-2 text-zinc-900">{{ $event->title }}</h3>
                                <p class="text-zinc-600 text-sm mb-4 line-clamp-2">{{ $event->subtitle ?? Str::limit($event->description, 100) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-zinc-900 font-medium">
                                        @if($event->tickets->isNotEmpty())
                                            NT$ {{ $event->tickets->min('price') }} 起
                                        @else
                                            尚未開放
                                        @endif
                                    </span>
                                    <a href="{{ route('events.show', $event->id) }}" class="inline-flex items-center text-sm font-medium text-purple-600 hover:text-purple-800">
                                        了解更多
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.client> 
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? '藝文活動網' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-neutral-100">
    <div class="min-h-screen flex flex-col">
        <!-- 頁首 -->
        <header class="bg-white border-b border-zinc-200">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <a href="{{ route('home') }}" class="font-semibold text-lg text-zinc-900">
                            藝文活動網
                        </a>
                    </div>

                    <!-- 主導航區 -->
                    <div class="hidden md:flex md:items-center md:space-x-4">
                        <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-800">首頁</a>
                        <a href="{{ route('events.index') }}" class="px-3 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-800">活動列表</a>
                    </div>

                    <!-- 使用者選單 -->
                    <div class="flex items-center">
                        @auth
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('user.dashboard') }}" class="px-3 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-800">我的帳戶</a>
                                
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-zinc-300">
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-zinc-200">
                                            <span class="text-sm font-medium text-zinc-600">{{ Auth::user()->name[0] }}</span>
                                        </span>
                                    </button>
                                    
                                    <div x-show="open" 
                                         @click.away="open = false"
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         class="absolute right-0 z-10 mt-2 w-48 origin-top-right bg-white rounded-md shadow-lg py-1"
                                         style="display: none;">
                                        <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100">我的帳戶</a>
                                        <a href="{{ route('user.orders.index') }}" class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100">我的訂單</a>
                                        <a href="{{ route('user.tickets.index') }}" class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100">我的票券</a>
                                        <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100">個人設定</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100">登出</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('login') }}" class="px-3 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-800">登入</a>
                                <a href="{{ route('register') }}" class="px-3 py-2 text-sm font-medium bg-zinc-800 text-white rounded-md hover:bg-zinc-700">註冊</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <!-- 頁面內容 -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- 頁尾 -->
        <footer class="bg-white border-t border-zinc-200 py-6">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center text-sm text-zinc-500">
                    <p>&copy; {{ date('Y') }} 藝文活動網. 保留所有權利。</p>
                </div>
            </div>
        </footer>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html> 
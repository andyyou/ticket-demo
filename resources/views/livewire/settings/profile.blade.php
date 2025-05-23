<div>
    <!-- 頁頭區域 -->
    <div class="bg-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-zinc-900 mb-2">帳號設定</h1>
            <p class="text-zinc-600">管理您的個人資料與安全</p>
        </div>
    </div>

    <!-- 主內容區域 -->
    <div class="bg-neutral-100 py-4">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- 個人資料卡片 -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center gap-6">
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-purple-100">
                            <span class="text-xl font-medium text-purple-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </span>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-zinc-900 mb-1">{{ Auth::user()->name }}</h2>
                        <p class="text-zinc-600 mb-4">{{ Auth::user()->email }}</p>
                        <livewire:profile.update-profile-information-form />
                    </div>
                </div>
            </div>
            <!-- 密碼變更 -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <h2 class="text-xl font-bold text-zinc-900 mb-2">密碼變更</h2>
                <p class="text-zinc-600 mb-6">請使用安全且獨特的新密碼</p>
                <livewire:profile.update-password-form />
            </div>
            <!-- 刪除帳號 -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-bold text-red-600 mb-2">刪除帳號</h2>
                <p class="text-zinc-600 mb-6">刪除後資料將無法復原，請謹慎操作</p>
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</div>

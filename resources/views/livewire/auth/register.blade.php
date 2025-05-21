<div class="min-h-screen bg-neutral-100 flex items-center justify-center py-12 px-4">
    <flux:card class="w-full max-w-md p-8">
        <div class="mb-8 text-center">
            <flux:heading size="xl">註冊新帳號</flux:heading>
            <flux:subheading>請填寫以下資訊完成註冊</flux:subheading>
        </div>
        <form wire:submit="register" class="flex flex-col gap-6">
            <flux:input
                wire:model="name"
                label="姓名"
                type="text"
                required
                autofocus
                autocomplete="name"
                placeholder="您的全名"
            />
            <flux:input
                wire:model="email"
                label="電子郵件"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
            />
            <flux:input
                wire:model="password"
                label="密碼"
                type="password"
                required
                autocomplete="new-password"
                placeholder="密碼"
                viewable
            />
            <flux:input
                wire:model="password_confirmation"
                label="確認密碼"
                type="password"
                required
                autocomplete="new-password"
                placeholder="再次輸入密碼"
                viewable
            />
            <flux:button type="submit" variant="primary" class="w-full">註冊</flux:button>
        </form>
        <div class="mt-6 text-center text-sm text-zinc-600">
            已經有帳號？
            <flux:link :href="route('login')" wire:navigate>登入</flux:link>
        </div>
    </flux:card>
</div>

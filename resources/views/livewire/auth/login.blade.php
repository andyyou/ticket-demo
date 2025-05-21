<div class="min-h-screen bg-neutral-100 flex items-center justify-center py-12 px-4">
    <flux:card class="w-full max-w-md p-8">
        <div class="mb-8 text-center">
            <flux:heading size="xl">會員登入</flux:heading>
            <flux:subheading>請輸入您的電子郵件與密碼</flux:subheading>
        </div>
        <form wire:submit="login" class="flex flex-col gap-6">
            <flux:input
                wire:model="email"
                label="電子郵件"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
            />
            <flux:input
                wire:model="password"
                label="密碼"
                type="password"
                required
                autocomplete="current-password"
                placeholder="密碼"
                viewable
            />
            <flux:checkbox wire:model="remember" label="記住我" />
            <flux:button variant="primary" type="submit" class="w-full">登入</flux:button>
        </form>
        <div class="mt-6 text-center text-sm text-zinc-600">
            還沒有帳號？
            <flux:link :href="route('register')" wire:navigate>註冊</flux:link>
        </div>
    </flux:card>
</div>

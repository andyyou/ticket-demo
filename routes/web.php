<?php

use App\Http\Controllers\Client\EventController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\NewsletterController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

// 客戶端頁面路由
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('events')->name('events.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('type/{type}', [EventController::class, 'byType'])->name('byType');
    Route::get('{id}', [EventController::class, 'show'])->name('show');
});

// 電子報訂閱路由
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{id}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// 結帳路由
Route::get('/checkout', function () {
    return view('client.checkout');
})->name('checkout');

// 用戶帳戶相關路由
Route::middleware(['auth', 'verified'])->prefix('user')->name('user.')->group(function () {
    // 用戶儀表板
    Route::get('/', function () {
        return view('client.user.dashboard');
    })->name('dashboard');
    
    // 用戶訂單路由
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', function () {
            return view('client.user.orders.index');
        })->name('index');
        
        Route::get('{id}', function ($id) {
            return view('client.user.orders.show');
        })->name('show');
    });
    
    // 用戶票券路由
    Route::prefix('tickets')->name('tickets.')->group(function () {
        Route::get('/', function () {
            return view('client.user.tickets.index');
        })->name('index');
        
        Route::get('{id}', function ($id) {
            return view('client.user.tickets.show');
        })->name('show');
    });
});

// 設定路由
Route::middleware(['auth'])->prefix('settings')->name('settings.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('settings.profile');
    });
    Route::get('/profile', \App\Livewire\Settings\Profile::class)->name('profile');
    Route::get('/password', \App\Livewire\Settings\Password::class)->name('password');
    Route::get('/appearance', \App\Livewire\Settings\Appearance::class)->name('appearance');
});

require __DIR__.'/auth.php';

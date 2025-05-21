<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * 顯示網站首頁
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 獲取精選活動 (以開始日期最接近現在的已發布活動為準)
        $featuredEvent = Event::where('status', Event::STATUS_PUBLISHED)
            ->where(function($query) {
                $query->whereNull('publish_at')
                      ->orWhere('publish_at', '<=', now());
            })
            ->where('start_at', '>=', now())
            ->orderBy('start_at')
            ->first();

        // 獲取最新活動 (最近發布的6個活動)
        $latestEvents = Event::where('status', Event::STATUS_PUBLISHED)
            ->where(function($query) {
                $query->whereNull('publish_at')
                      ->orWhere('publish_at', '<=', now());
            })
            ->where('start_at', '>=', now())
            ->orderBy('start_at')
            ->take(6)
            ->get();

        // 獲取活動類型清單
        $typeNames = Event::getTypeNames();

        return view('client.home', compact('featuredEvent', 'latestEvents', 'typeNames'));
    }
} 
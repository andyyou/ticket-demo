<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * 顯示活動列表
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Event::query()
            ->where('status', Event::STATUS_PUBLISHED)
            ->whereNull('publish_at')
            ->orWhere('publish_at', '<=', now())
            ->orderBy('start_at');

        // 根據類型篩選
        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        // 根據關鍵字搜尋
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('subtitle', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('venue_name', 'like', "%{$search}%");
            });
        }

        $events = $query->paginate(9);
        $typeNames = Event::getTypeNames();

        return view('client.events.index', compact('events', 'typeNames'));
    }

    /**
     * 顯示特定活動的詳情
     * 
     * @param string $id 活動ID或slug
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // 先嘗試使用ID查詢，如果無法找到再嘗試使用slug查詢
        $event = Event::where('id', $id)
            ->orWhere('slug', $id)
            ->firstOrFail();

        // 確保活動已經發布
        if (!$event->isPublished()) {
            abort(404);
        }

        // 預先載入票種資訊
        $event->load('tickets');

        return view('client.events.show', compact('event'));
    }

    /**
     * 依照類型顯示活動
     * 
     * @param string $type 活動類型
     * @return \Illuminate\View\View
     */
    public function byType($type)
    {
        // 檢查類型是否有效
        $typeNames = Event::getTypeNames();
        if (!array_key_exists($type, $typeNames)) {
            abort(404);
        }

        $events = Event::where('type', $type)
            ->where('status', Event::STATUS_PUBLISHED)
            ->where(function($query) {
                $query->whereNull('publish_at')
                      ->orWhere('publish_at', '<=', now());
            })
            ->orderBy('start_at')
            ->paginate(9);

        $typeName = $typeNames[$type];

        return view('client.events.by_type', compact('events', 'type', 'typeName', 'typeNames'));
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    /**
     * 處理電子報訂閱請求
     */
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator, 'newsletter')
                ->withInput();
        }

        // 檢查電子郵件是否已存在
        $newsletter = Newsletter::where('email', $request->email)->first();

        if ($newsletter) {
            // 若已存在但曾取消訂閱，則重新啟用
            if ($newsletter->status === Newsletter::STATUS_UNSUBSCRIBED) {
                $newsletter->markAsActive();
                return redirect()->back()->with('success', '您已重新訂閱我們的電子報！');
            }
            
            // 若已存在且為活躍狀態，回傳訊息
            return redirect()->back()->with('info', '此電子郵件已訂閱我們的電子報。');
        }

        // 創建新訂閱
        $newsletter = new Newsletter();
        $newsletter->email = $request->email;
        $newsletter->status = Newsletter::STATUS_ACTIVE;
        $newsletter->subscribed_at = now();
        $newsletter->save();

        return redirect()->back()->with('success', '感謝您訂閱我們的電子報！');
    }

    /**
     * 處理取消訂閱請求
     */
    public function unsubscribe(Request $request, $id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->markAsUnsubscribed();

        return redirect()->route('home')->with('success', '您已成功取消訂閱電子報。');
    }
} 
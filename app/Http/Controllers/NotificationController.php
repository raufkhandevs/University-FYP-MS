<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;
        return view('notifications.index', [
            'notifications' => $notifications
        ]);
    }

    public function getNotification(Request $request)
    {
        $notification = DB::table('notifications')->where('id', $request->notification_id)->first();

        if (!$notification) {
            return response(404);
        }

        auth()->user()
            ->unreadNotifications
            ->when($request->input('notification_id'), function ($query) use ($request) {
                return $query->where('id', $request->input('notification_id'));
            })
            ->markAsRead();

        return response([
            'status' => 200,
            'notification' => $notification
        ], 200);
    }
}

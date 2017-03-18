<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Notification;
use Auth;

class NotificationController extends Controller
{
    public function paginate()
    {
        $notifications = Notification::whereNotifiableId(Auth::id())
            ->orderBy('created_at', 'DESC')
            ->paginate();

        return response()->json($notifications);
    }

    public function index()
    {
        return view('users.notifications.index')
            ->withTitle('Notifikasi');
    }

    public function read()
    {
        $notification = Notification::whereId(request('id'))
            ->whereNotifiableId(Auth::id())
            ->first();

        // mark as read
        $notification->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}

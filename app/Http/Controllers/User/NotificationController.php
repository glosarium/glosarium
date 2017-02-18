<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        return view('users.notifications.index')
            ->withTitle('Notifikasi');
    }
}

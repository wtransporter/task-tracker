<?php

namespace App\Http\Controllers;

class UserNotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications;

        return view('user.notification.index', compact('notifications'));
    }
}

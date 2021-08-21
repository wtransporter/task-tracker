<?php

namespace App\Http\Controllers;

class UserNotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications;

        return view('user.notification.index', compact('notifications'));
    }

    public function store($id)
    {
        auth()->user()->notifications->where('id', $id)->markAsRead();

        return redirect()->route('notifications');
    }

    public function readAll()
    {
        auth()->user()->notifications->markAsRead();

        return redirect()->route('notifications');
    }
}

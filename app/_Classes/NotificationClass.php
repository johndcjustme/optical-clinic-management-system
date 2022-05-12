<?php

namespace App\_Classes;

use App\Models\User;
use App\Models\Notification;

class NotificationClass {
    public function notify($title, $description) {
        foreach (User::whereRoleIs('admin')->orWhereRoleIs('staff')->get() as $user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => $title,
                'desc' => $description,
            ]);
        }
    }

    public function is_read($notificatonId)
    {
        Notification::findOrFail($notificatonId)->update(['is_read' => true]);
    }

    public function read_all() 
    {
        Notification::findOrFail(Auth::user()->id)->where('is_read', false)->update(['is_read' => true]);
    }
}
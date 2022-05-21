<?php


use App\Models\User;
use App\Models\Member;
use App\Models\Notification;


function notify($type, $title, $description, $link = null, $userId = null)
{
    switch ($type) {
        case 'admin-staff': 
            foreach (User::whereRoleIs('admin')->orWhereRoleIs('staff')->get() as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => $title,
                    'desc' => $description,
                    'is_read' => false,
                    'link' => $link,
                ]);
            }
            break;

        case 'newUser': 
            foreach (User::whereRoleIs('admin')->orWhereRoleIs('staff')->get() as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => $title,
                    'desc' => $description,
                    'is_read' => false,
                ]);
            }
            break;

        case 'newPost':
            foreach (Member::where('user_id', '!=', Auth::user()->id)->get() as $member) {
                Notification::create([
                    'user_id' => $member->user_id,
                    'title' => $title,
                    'desc' => $description,
                    'link' => $link,
                    'is_read' => false,
                ]);
            }
            break;
        
        case 'createdAppt':
            Notification::create([
                'user_id' => $userId,
                'title' => $title,
                'desc' => $description,
                'is_read' => false,
            ]);
            break;
    }
}

function notifyOnPost()
{
}

function is_read($notificationId)
{
    Notification::select(['id','is_read'])->findOrFail($notificationId)->update(['is_read' => true]);
}

function read_all()
{
    Notification::select(['id','is_read'])->findOrFail(Auth::user()->id)->where('is_read', false)->update(['is_read' => true]);
}
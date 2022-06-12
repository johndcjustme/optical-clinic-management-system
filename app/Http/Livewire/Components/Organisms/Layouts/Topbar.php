<?php

namespace App\Http\Livewire\Components\Organisms\Layouts;

use Livewire\Component;
// use App\Models\Post;
// use App\Models\Comment;
// use App\Models\Like;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Notification;
use App\_Classes\NotificationClass;


class Topbar extends Component
{    
    public $today;

    public function render()
    {

        $this->today = date('Y-m-d');

        $current_user = Auth::user()->id;
        
        $notifications = Notification::select(['title', 'desc', 'created_at'])
                            ->where('user_id', $current_user)
                            ->where('is_read', false)
                            ->orderByDesc('created_at')
                            ->get();

        return view('livewire.components.organisms.layouts.topbar', [
            'notifications' => $notifications,
        ]);
    }

    public function is_read($notificationId)
    {
        is_read($notificationId);
    }

    public function read_all()
    {
        read_all();
    }
}




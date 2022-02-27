<?php

namespace App\Http\Livewire\Components\Organisms\Layouts;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;

class Forum extends Component
{

    public $adminId = 1;

    // public $userComment = '';

    public function render()
    {
        $posts = Post::with('patient')->with('user')->latest()->get();
        $comments = Comment::with('patient')->with('user')->latest()->get();
        return view('livewire.components.organisms.layouts.forum', ['posts' => $posts, 'comments' => $comments]);
    }

    // public function createComment($id)
    // {
    //     dd('hello this is your comments');
    // }
}

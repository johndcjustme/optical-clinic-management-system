<?php

namespace App\Http\Livewire\Components\Organisms\Layouts;

use Livewire\Component;
use App\Models\Post;

class Topbar extends Component
{
    public $forumWindow_IsOpen = true;

    public function render()
    {
        $posts = Post::with('patient')->with('user')->latest()->get();
        return view('livewire.components.organisms.layouts.topbar', ['posts' => $posts]);
    }
}

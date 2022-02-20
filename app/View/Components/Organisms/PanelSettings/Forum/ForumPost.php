<?php

namespace App\View\Components\Organisms\PanelSettings\Forum;

use Illuminate\View\Component;

class ForumPost extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $postType;
    public $optionId;
    public $content;
    public $postedOn;
    public $name;


    public function __construct($id, $postType, $content, $postedOn, $name)
    {
        $this->id = $id;
        $this->postType = $postType;
        $this->content = $content;
        $this->postedOn = $postedOn;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */


    public function render()
    {
        return view('components.organisms.panel-settings.forum.forum-post');
    }
}

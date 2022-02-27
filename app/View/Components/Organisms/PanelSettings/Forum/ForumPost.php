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
    public $countComments;
    public $wireComment;
    public $wireSubmit;
    public $toggleCommentSection;
    public $currentUser;
    public $onLike;
    public $countLikes;
    public $onDislike;
    public $countDislikes;


    public function __construct($id, $postType, $content, $postedOn, $name, $wireComment, $wireSubmit, $toggleCommentSection, $currentUser, $countComments, $onLike, $countLikes, $onDislike, $countDislikes)
    {
        $this->id = $id;
        $this->postType = $postType;
        $this->content = $content;
        $this->postedOn = $postedOn;
        $this->name = $name;
        $this->wireComment = $wireComment;
        $this->wireSubmit = $wireSubmit;
        $this->toggleCommentSection = $toggleCommentSection;
        $this->currentUser = $currentUser;
        $this->countComments = $countComments;
        $this->onLike = $onLike;
        $this->countLikes = $countLikes;
        $this->onDislike = $onDislike;
        $this->countDislikes = $countDislikes;
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

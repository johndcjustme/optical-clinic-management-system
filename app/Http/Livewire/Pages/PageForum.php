<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Like;
use App\Models\Member;
use App\Models\Commentcomment;
use App\Models\Comment_in_comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Storage;



class PageForum extends Component
{

    public $postContent = '';

    public $commentContent = '';

    public $subPage = 1;

    public $deleteId;

    public $newPost = false;

    public $delete = [
        'post' => false,
        'comment' => false,
    ];

    protected $queryString = [
        'subPage',
    ];

    public function render()
    {


        return view('livewire.pages.page-forum', [
            'posts' => Post::with('user')->latest()->get(),
            'comments' => Comment::with('user')->latest()->get(),
            'commentcomments' => Commentcomment::with('user')->latest()->get(),
        ])
            ->extends('layouts.app')
            ->section('content');
    }


    public function joinForum($userId)
    {
        $member = Member::create([ 'user_id' => $userId ]);
        
        $member 
            ? $this->dispatchBrowserEvent('toast',[
                    'title' => null,
                    'class' => 'success',
                    'message' => 'Congratulations. You are now a member of this forum.',
                ])
            : $this->dispatchBrowserEvent('toast',[
                    'title' => null,
                    'class' => 'error',
                    'message' => 'Error. Please try again.',
                ]);
    }


    public function checkMember($userId)
    {
        return Member::where('user_id', $userId)->first();
    }




    public function createPost()
    {
        $this->validate(['postContent' => 'required|max:100']);

        Post::create([
            'user_id' => Auth::user()->id,
            'post_content' => $this->postContent,
        ]);

        $this->newPost = false;
        $this->postContent = '';
    }





    public function replyComment($commentId, $userId)
    {
        // dd($commentId . ' ' . $userId);
        Commentcomment::create([
            'user_id' => $userId,
            'comment_id' => $commentId,
            'comment' => $this->commentContent,
        ]);
        $this->commentContent = '';
    }



    public function replyPost($postId, $userId)
    {
        Comment::create([
            'post_id' => $postId,
            'user_id' => $userId,
            'comment_content' => $this->commentContent,
        ]);

        $this->commentContent = '';
    }

    public function deletingPost($postId)
    {
        $this->deleteId = $postId;
        $this->delete['post'] = true;
        $this->dispatchBrowserEvent('confirm-dialog'); 
    }

    public function deletePost()
    {
        Post::destroy($this->deleteId);
        $this->confirm_dialog_modal_close();
        $this->dispatchBrowserEvent('toast',[
            'title' => null,
            'class' => 'success',
            'message' => 'Post deleted.',
        ]);
    }

    public function deletingComment($commentId)
    {
        $this->deleteId = $commentId;
        $this->delete['comment'] = true;
        $this->dispatchBrowserEvent('confirm-dialog'); 
    }

    public function deleteComment()
    {
        $comment = Comment::destroy($this->deleteId);
        $this->confirm_dialog_modal_close();
        $this->dispatchBrowserEvent('toast',[
            'title' => null,
            'class' => 'success',
            'message' => 'Comment deleted.',
        ]);
    }

    public function likePost($postId, $userId)
    {
        // dd($postId, $userId);
        $like = Like::where('post_comment_id', $postId)
                ->where('user_id', $userId)
                ->where('post_type', 1)->first();

        $like 
            ? Like::destroy($like->id) 
            : Like::create([
                'post_comment_id' => $postId,
                'user_id' => $userId,
                'post_type' => 1,
            ]);
    }

    public function likeComment($commentId, $userId, $postType)
    {
        // dd($postId, $userId);
        $like = Like::where('post_comment_id', $commentId)
                ->where('user_id', $userId)
                ->where('post_type', $postType)->first();

        $like 
            ? Like::destroy($like->id) 
            : Like::create([
                'post_comment_id' => $commentId,
                'user_id' => $userId,
                'post_type' => $postType,
            ]);
    }


    public function confirm()
    {
        if ($this->delete['post']) {
            $this->deletePost();
        }

        if ($this->delete['comment']) {
            $this->deleteComment();
        }
    }




    public function liked($postId, $userId, $postType)
    {
        return Like::where('post_comment_id', $postId)
                ->where('user_id', $userId)
                ->where('post_type', $postType)->first();
    }


    public function countPostLikes($postId)
    {
        return Like::where('post_comment_id', $postId)->where('post_type', 1)->count();
    }

    public function countCommentLikes($commentId, $postType)
    {
        return Like::where('post_comment_id', $commentId)->where('post_type', $postType)->count();
    }

    public function countPostComments($postId)
    {
        return Comment::where('post_id', $postId)->count();
    }

    public function countCommentComments($commentId)
    {
        return Commentcomment::where('comment_id', $commentId)->count();
    }

    public function countPosts()
    {
        $posts = Post::all()->count();
        return $posts > 1 ? $posts . ' Posts' : $posts . ' Post';
    }

    public function countMembers()
    {
        $members = Member::all()->count();
        return $members > 1 ? $members . ' Members' : $members . ' Member';
    }




    public function date($date) { return \Carbon\Carbon::parse($date)->isoFormat('MMM D, YYYY'); }


    public function storage($url) 
    {
        if (!empty($url) || ($url != null)) {
            return Storage::disk('avatars')->url($url); } 
        else {
            return Storage::disk('avatars')->url('default-user-avatar.png'); } 
    }

    public function confirm_dialog_modal_close() { $this->dispatchBrowserEvent('confirm-dialog-close'); }
}

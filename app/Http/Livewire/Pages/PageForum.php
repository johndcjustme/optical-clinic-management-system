<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post_photo;
use App\Models\Like;
use App\Models\Member;
use App\Models\Message;
use App\Models\Chatroom;
use App\Models\Commentcomment;
use App\Models\Comment_in_comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Models\Rule;

use Illuminate\Support\Facades\Storage;




class PageForum extends Component
{

    use WithFileUploads;
    
    public $postContent = '';

    public $commentContent = '';

    public $subPage = 1;

    public $deleteId;

    public $body = '';

    public $room, $message = false;

    public $newPost = false;

    public $patient = 0;

    public $photos;

    public $limit = 15;

    public $openComment = false;

    public $viewPhoto = false, $displayPhoto;

    public $text_rule;

    public $delete = [
        'post' => false,
        'comment' => false,
    ];

    protected $queryString = [
        'subPage', 
        'room' => ['except' => '', 'except' => 0],
        'patient' => ['except' => '', 'except' => 0],
    ];

    public function loadMore() 
    {
        $this->limit += 15;
    }

    public function render()
    {
        return view('livewire.pages.page-forum', [
            'posts' => Post::with(['user'])->latest()->limit($this->limit)->get(),
            'comments' => Comment::with(['user'])->latest()->get(),
            'commentcomments' => Commentcomment::with(['user'])->latest()->get(),
            'chatrooms' => Chatroom::with(['user'])->latest('updated_at')->limit(50)->get(),
            'members' => Member::with(['user'])->get(),
        ])
            ->extends('layouts.app')
            ->section('content');
    }




    public function addRule()
    {
        $this->validate([
            'text_rule' => 'required|max:255'
        ]); 

        Rule::create(['rule' => $this->text_rule]);
        $this->text_rule = '';
    }

    public function deleteRule($ruleId) 
    {
        Rule::destroy($ruleId);
    }





    public function uploadPhotos()
    {
        dd($this->photos);
    }



    public function viewPhoto($postId)
    {
        $photo = Post_photo::where('post_id', $postId)->first()->name;
        $this->displayPhoto = storage('items', $photo);
        $this->viewPhoto = true;
    }

    public function closeModal()
    {
        $this->viewPhoto = false;
    }







    public function validationInput()
    {
        $this->validate(
            [ 'body' => 'required|max:255', ],
            [ 'body.required' => 'Write some message.', ]
        );
    }


    public function subPage($value)
    {        
        $value == 2 
            ? Message::where('receiver_id', Auth::user()->id)->update(['is_read' => true])
            : '';
        $this->subPage = $value;
    }

    public function room($patientId)
    {   
        Message::where('receiver_id', Auth::user()->id)->update(['is_read' => true]);

        $chatroom = Chatroom::where('user_id', $patientId)->first();
        $chatroom->update(['new_message' => 0]);

        // $this->message = true;
        $this->patient = $patientId;
    }
    
    public function joinForum($userId)
    {
        $member = Member::create([ 'user_id' => $userId ]);
        
        $member 
            ? $this->dispatchBrowserEvent('toast',[
                    'title' => null,
                    'class' => 'success',
                    'message' => 'Congratulations. You are now a member of this forum.', ])
            : $this->dispatchBrowserEvent('toast',[
                    'title' => null,
                    'class' => 'error',
                    'message' => 'Error. Please try again.', ]);
    }


    public function checkMember($userId)        { return Member::where('user_id', $userId)->first(); }


    public function createPost()
    {
        $this->validate([
            'postContent' => 'required|max:100',
            'photos.*' => 'image|max:2048|nullable',
        ]);

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'post_content' => $this->postContent,
        ]);

        if (!empty($this->photos)) {
            foreach ($this->photos as $photo) {
                Post_photo::create([
                    'post_id' => $post->id, 
                    'name' => $photo->hashName(),
                ]);
                $photo->store('/', 'items');
            }
        }

        $postId = '#post_' . $post->id;

        notify('newPost', Auth::user()->name . ' posted', $this->postContent, '/forum?subPage=1' . $postId);

        $this->newPost = false;
        $this->postContent = '';
        $this->photos = [];

    }





    public function replyComment($commentId, $userId)
    {
        // dd($commentId . ' ' . $userId);
        Commentcomment::create([
            'user_id' => $userId,
            'comment_id' => $commentId,
            'comment' => $this->commentContent,
        ]);

        notify('newPost', Auth::user()->name . ' replied on a comment', $this->commentContent, '/forum');

        $this->commentContent = '';
    }


    public function replyPost($postId, $userId)
    {
        $comment = Comment::create([
            'post_id' => $postId,
            'user_id' => $userId,
            'comment_content' => $this->commentContent,
        ]);

        notify('newPost', Auth::user()->name . ' commented on a post', $this->commentContent, '/forum');

        $this->commentContent = '';
    }

    public function deletingPost($postId)
    {
        $this->deleteId = $postId;
        $this->delete['post'] = true;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Delete Post',
            'content' => 'Are you sure you want to delete this post?'
        ]); 
    }

    public function deletePost()
    {
        $photos = Post_photo::where('post_id', $this->deleteId);
        
        if ($photos) {
            foreach ($photos->get() as $photo) {
                Storage::disk('items')->exists($photo->name) 
                    ? Storage::disk('items')->delete($photo->name) : '' ;
            }
            $photos->delete();
        }

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
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Delete Comment',
            'content' => 'Are you sure you want to delete this comment?'
        ]); 
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
        $this->delete['post'] ? $this->deletePost() : '';
        $this->delete['comment'] ? $this->deleteComment() : '';
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
        $posts = Post::count();
        return $posts > 1 ? $posts . ' Posts' : $posts . ' Post';
    }

    public function countMembers()
    {
        $members = Member::count();
        return $members > 1 
                    ? $members . ' Members' 
                    : $members . ' Member';
    }


    public function displayMessage($patientId) 
    {
        return Message::with('user')->where('sender_id', $patientId)->orWhere('receiver_id', $patientId)->latest()->limit(50)->get();
    }


    public function newMessage($userId)
    {
        $count = Message::where('receiver_id', $userId)->where('is_read', false)->count();

        return $count > 0 
                    ? '• ' . $count 
                    : '';
    }

    public function sendMessage($senderId, $receiverId) 
    {
        // dd($senderId .' ' . $receiverId . $this->body);
        $this->validationInput();

        if ($senderId != 1) {
            Chatroom::updateOrCreate(
                ['user_id' => $senderId],
                ['user_id' => $senderId, 'new_message' => DB::raw('new_message + 1')]);
        }

        Message::create([
            'sender_id' => $senderId,
            'body' => $this->body,
            'receiver_id' => $receiverId,
            'is_read' => false, ]);             
   
        $this->body = '';
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

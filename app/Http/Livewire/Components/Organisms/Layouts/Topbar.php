<?php

namespace App\Http\Livewire\Components\Organisms\Layouts;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Arr;

class Topbar extends Component
{

    public 
        $panelSettings_isOpen = false,
            $forum_isOpen = false,
            $notif_isOpen = false;

    // public ;

    public 
        $userComment = '',
        $textarea = '',
        $textOnEditPost,
        $textOnEditComment,
        $update_post_comment;

    public 
        $showModal = false,
        $modalPosition = 'top: -5em;',
            $modalNewPost = false,
            $modalEditPost = false,
            $modalEditComment = false;
    
    public $adminId = 1, $userRole = 'admin';

    public $commentSectionIsOpen = true, $thisPost;


    public $today;


    public function render()
    {

        $this->today = date('Y-m-d');

        $posts = Post::with('patient')->with('user')->latest()->get();
        $comments = Comment::with('patient')->with('user')->latest()->get();

        return view('livewire.components.organisms.layouts.topbar', ['posts' => $posts, 'comments' => $comments, 'likes' => Like::all()]);
    }

    // protected $rules = [
    //     'textarea' => 'required',
    //     'textOnEditPost' => 'required',
    //     'textOnEditComment' => 'required',
    // ];

    // protected $messages = [
    //     'textarea.required' => 'This field is required',
    // ];


    public function resetField()
    {
        $this->reset([
            'showModal',
            'modalPosition',
            'modalNewPost',
            'modalEditPost',
            'modalEditComment',
            'textOnEditPost',
            'textOnEditComment',
            'textarea',
        ]);
    }

    public function reaction($postType, $reaction, $post_comment_id, $user_id, $patient_user_role, $like_dislike, $userIdWhoReacted, $roleOfUserWhoReacted)
    {
        $like_dislike++;
        // dd($postType . ' ' . $reaction . ' post_comment_id:' . $post_comment_id . ' patient_user_role:' . $role  . ' user_id:' . $user_id . ' likes_count:' . $like_dislike . ' user how liked:' . $userIdWhoReacted .  ' role:' . $roleOfUserWhoReacted);

        switch ($reaction) {
            case true:
                switch ($postType) {
                    case 'post':
                        $isLiked = Like::where('post_comment_id', $post_comment_id)
                        ->where('patient_user_id', $user_id)
                        ->where('reacted_by_patient_user_id', $userIdWhoReacted)
                        ->where('role', $patient_user_role)
                        ->where('post_type', $postType)
                        ->where('reacted_by_role', $roleOfUserWhoReacted)
                        ->where('like_dislike', $reaction)
                        ->first();

                        $setToLiked = Like::where('post_comment_id', $post_comment_id)
                            ->where('patient_user_id', $user_id)
                            ->where('reacted_by_patient_user_id', $userIdWhoReacted)
                            ->where('role', $patient_user_role)
                            ->where('post_type', $postType)
                            ->where('reacted_by_role', $roleOfUserWhoReacted)
                            ->where('like_dislike', false)
                            ->first();

                        if($isLiked) {
                            $isLiked->delete();
                        } else {

                            if($setToLiked) { 
                                $setToLiked->update(['like_dislike' => true]); 
                            } 
                            else {
                                Like::create([
                                    'post_comment_id' => $post_comment_id,
                                    'patient_user_id' => $user_id,
                                    'role' => $patient_user_role,
                                    'post_type' => $postType,
                                    'like_dislike' => $reaction,
                                    'reacted_by_patient_user_id' => $userIdWhoReacted,
                                    'reacted_by_role' => $roleOfUserWhoReacted,
                                ]);
                            }
                        }
                        break;

                    case 'comment':
                        $isLiked = Like::where('post_comment_id', $post_comment_id)
                        ->where('patient_user_id', $user_id)
                        ->where('reacted_by_patient_user_id', $userIdWhoReacted)
                        ->where('role', $patient_user_role)
                        ->where('post_type', $postType)
                        ->where('reacted_by_role', $roleOfUserWhoReacted)
                        ->where('like_dislike', $reaction)
                        ->first();

                        $setToLiked = Like::where('post_comment_id', $post_comment_id)
                            ->where('patient_user_id', $user_id)
                            ->where('reacted_by_patient_user_id', $userIdWhoReacted)
                            ->where('role', $patient_user_role)
                            ->where('post_type', $postType)
                            ->where('reacted_by_role', $roleOfUserWhoReacted)
                            ->where('like_dislike', false)
                            ->first();

                        if($isLiked){
                            $isLiked->delete();
                        } else {

                            if($setToLiked) { 
                                $setToLiked->update(['like_dislike' => true]); 
                            } 
                            else {
                                Like::create([
                                    'post_comment_id' => $post_comment_id,
                                    'patient_user_id' => $user_id,
                                    'role' => $patient_user_role,
                                    'post_type' => $postType,
                                    'like_dislike' => $reaction,
                                    'reacted_by_patient_user_id' => $userIdWhoReacted,
                                    'reacted_by_role' => $roleOfUserWhoReacted,
                                ]);
                            }
                        }
                        break;
                }
                break;

            case false:
                switch ($postType) {
                    case 'post':
                        $isDisliked = Like::where('post_comment_id', $post_comment_id)
                        ->where('patient_user_id', $user_id)
                        ->where('reacted_by_patient_user_id', $userIdWhoReacted)
                        ->where('role', $patient_user_role)
                        ->where('post_type', $postType)
                        ->where('reacted_by_role', $roleOfUserWhoReacted)
                        ->where('like_dislike', $reaction)
                        ->first();

                        $setToUnliked = Like::where('post_comment_id', $post_comment_id)
                            ->where('patient_user_id', $user_id)
                            ->where('reacted_by_patient_user_id', $userIdWhoReacted)
                            ->where('role', $patient_user_role)
                            ->where('post_type', $postType)
                            ->where('reacted_by_role', $roleOfUserWhoReacted)
                            ->where('like_dislike', true)
                            ->first();

                        if($isDisliked){
                            $isDisliked->delete();
                        } else {

                            if($setToUnliked) { 
                                $setToUnliked->update(['like_dislike' => false]); 
                            } 
                            else {
                                Like::create([
                                    'post_comment_id' => $post_comment_id,
                                    'patient_user_id' => $user_id,
                                    'role' => $patient_user_role,
                                    'post_type' => $postType,
                                    'like_dislike' => $reaction,
                                    'reacted_by_patient_user_id' => $userIdWhoReacted,
                                    'reacted_by_role' => $roleOfUserWhoReacted,
                                ]);
                            }
                        }
                        break;

                    case 'comment':
                        $isDisliked = Like::where('post_comment_id', $post_comment_id)
                        ->where('patient_user_id', $user_id)
                        ->where('reacted_by_patient_user_id', $userIdWhoReacted)
                        ->where('role', $patient_user_role)
                        ->where('post_type', $postType)
                        ->where('reacted_by_role', $roleOfUserWhoReacted)
                        ->where('like_dislike', $reaction)
                        ->first();

                        $setToUnliked = Like::where('post_comment_id', $post_comment_id)
                            ->where('patient_user_id', $user_id)
                            ->where('reacted_by_patient_user_id', $userIdWhoReacted)
                            ->where('role', $patient_user_role)
                            ->where('post_type', $postType)
                            ->where('reacted_by_role', $roleOfUserWhoReacted)
                            ->where('like_dislike', true)
                            ->first();

                        if($isDisliked){
                            $isDisliked->delete();
                        } else {
                            if($setToUnliked) { 
                                $setToUnliked->update(['like_dislike' => false]); 
                            } 
                            else {
                                Like::create([
                                    'post_comment_id' => $post_comment_id,
                                    'patient_user_id' => $user_id,
                                    'role' => $patient_user_role,
                                    'post_type' => $postType,
                                    'like_dislike' => $reaction,
                                    'reacted_by_patient_user_id' => $userIdWhoReacted,
                                    'reacted_by_role' => $roleOfUserWhoReacted,
                                ]);
                            }
                        }
                        break;
                }
                break;
        }

        $postType = ''; 
        $reaction = '';
        $post_comment_id = '';
        $user_id = '';
        $patient_user_role = '';
        $like_dislike = '';
        $userIdWhoReacted = '';
        $roleOfUserWhoReacted = '';
        $setToLiked='';
        $setToUnliked ='';
    }

    public function newPost()
    {
        if(!empty($this->textarea)) {
            $newComment = Post::create([
                'patient_user_id' => $this->adminId,
                'role' => 'admin',
                'post_content' => $this->textarea,
            ]);
            $this->resetField();
        }
    }

    public function updatePost()
    {
        if(!empty($this->textOnEditPost)) {
            $idToUpdate = $this->update_post_comment;
            $updatePost = Post::find($idToUpdate);
            $updatePost->update([
                'post_content' => $this->textOnEditPost,
            ]);
            $this->resetField();
        }
    }

    public function newComment($id)
    {
        if(!empty($this->textarea)) {
            $newComment = Comment::create([
                'post_id' => $id,
                'patient_user_id' => $this->adminId,
                'role' => 'admin',
                'comment_content' => $this->textarea,
            ]);
            $this->textarea = '';
        }
    }

    public function updateComment()
    {
        if(!empty($this->textOnEditComment)) {
            $idToUpdate = $this->update_post_comment;
            $updateComment = Comment::find($idToUpdate);
            $updateComment->update([
                'comment_content' => $this->textOnEditComment,
            ]);
            $this->resetField();
        }
    }

    public function onShowModal($data, $idOnUpdate)
    {
        // $this->showModal = true;
        switch ($data) {
            case 'isNewPost':
                $this->modalNewPost = true;
                break;
            case 'isEditPost':
                $findPost = Post::findOrFail($idOnUpdate);
                $this->textOnEditPost = $findPost->post_content;
                $this->update_post_comment = $idOnUpdate;
                $this->modalEditPost = true;
                break;
            case 'isEditComment':
                $findComment = Comment::findOrFail($idOnUpdate);
                $this->textOnEditComment = $findComment->comment_content;
                $this->update_post_comment = $idOnUpdate;
                $this->modalEditComment = true;
                break;
        }
        $this->modalPosition = 'top: -2em;';
    }

    public function showPanelSettings($data) 
    {
        switch ($data) {
            case 'forum_isOpen':
                $this->forum_isOpen = true;
                break;
            case 'notif_isOpen':
                $this->notif_isOpen = true;
                break;
        }
        $this->panelSettings_isOpen = true;

    }

    public function closePanelSettings()
    {
        $this->reset([
            'panelSettings_isOpen',
            'notif_isOpen',
            'forum_isOpen',
        ]);
    }

    public function onCloseModal()
    {
        $this->resetField();
    }

    public function deletePost($id)
    {
        Post::find($id)->delete();
    }

    public function deleteComment($id)
    {
        Comment::find($id)->delete();
    }

    public function toggleCommentSection($postId)
    {
        if ($this->thisPost == $postId) {
            return $this->thisPost = 0;
        } else {
            return $this->thisPost = $postId;
        }
        $this->commentSectionIsOpen = true;
    }
}




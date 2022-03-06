<div class="topbar flex flex_x_between flex_y_center">
    <div class="flex flex_y_center">
        {{-- <span class="mr_10" style="display: none">
            <i class="fas fa-bars"></i>
        </span>
        <h5 class="uppercase" style="letter-spacing: 0.1rem">
        </h5> --}}
     
    </div>
    <div class="flex gap_1 flex_y_center">
        <div wire:click="showPanelSettings('forum_isOpen')" class="relative">
            <i class="fa-regular fa-comments"></i>
            <span class="absolute top bg_red" 
                style="
                    right: -0.2em; 
                    height: 0.6em; 
                    width: 0.6em; 
                    border: 2px solid white; 
                    border-radius: 50%;
                ">
            </span>
        </div>
        <div wire:click="showPanelSettings('notif_isOpen')" class="relative">
            <i class="fa-regular fa-bell"></i>
            <span class="absolute top bg_red" 
                style="
                    right: -0.2em; 
                    height: 0.6em; 
                    width: 0.6em; 
                    border: 2px solid white; 
                    border-radius: 50%;
                ">
            </span>
        </div>
        <div class="ml_7">
            <div class="flex flex_y_center">
                <div onclick="window.location.assign('/account')">
                    <x-atom.profile-photo size="30px" path="storage/photos/avatars/{{ session()->get('curr_user_avatar')}}"/>
                </div>
            </div>
        </div>
    </div>
    
    
    @if ($this->panelSettings_isOpen)    
        <x-organisms.panel-settings wire-toggle="closePanelSettings">

            
            @if ($this->forum_isOpen)
                @section('title', 'Forum')
                @section('desc', 'Some description')
            
                @section('create-post')
                    <div id="createPost" class="absolute right mt_20 p_15" style="{{ $modalPosition }} background: rgb(73, 92, 255); width: 100%; z-index: 200; border-bottom-left-radius: 1.5em; border-bottom-right-radius: 1.5em; transition: 0.3s; {{ $showModal }}">
                        @if ($modalNewPost || $modalEditPost || $modalEditComment)

                            @php
                                $text = 'textarea';
                                if ($modalNewPost) {
                                    $title = 'NEW POST'; 
                                    $submitTo = 'newPost';
                                    $button = 'POST';
                                    $text = 'textarea';
                                }
                                if ($modalEditPost) {
                                    $title = 'EDIT POST'; 
                                    $submitTo = 'updatePost';
                                    $button = 'SAVE CHANGES';
                                    $text = 'textOnEditPost';
                                }
                                if ($modalEditComment) {
                                    $title = 'EDIT COMMENT'; 
                                    $submitTo = 'updateComment';
                                    $button = 'SAVE CHANGES';
                                    $text = 'textOnEditComment';
                                }
                            @endphp

                            <h5>{{ $title }}</h5>
                            <br>
                            <form wire:submit.prevent="{{ $submitTo }}">
                                <input wire:model.defer="update_post_comment" type="hidden">
                                <textarea id="textarea" wire:model.defer="{{ $text }}" class="overflow_hidden" placeholder="Write somthing ..." style="height: 150px;"></textarea>
                                <div class="flex flex_y_center flex_x_end gap_1 mt_10">
                                    <div>
                                        <a href="#" wire:click.prevent="onCloseModal" class="nodecoration text_button">CANCEL</a>
                                    </div>
                                    <div>
                                        <button type="submit">{{ $button }} </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                @endsection


                <div class="forum_container slow">
                        
                    @foreach ($posts as $post)
            
                        <x-organisms.panel-settings.forum.forum-container>
                            <x-organisms.panel-settings.forum.forum-post
                                post-type="post"
                                id="{{ $post->id }}"
                                current-user="{{ $adminId === $post->patient_user_id && 'admin' === $post->role ? 'accent_1' : '' }}" {{-- current logged in user--}}
                                name="{{ $post->role == 'patient' ? $post->patient->patient_fname . ' ' . $post->patient->patient_mname . ' ' . $post->patient->patient_lname : $post->user->name }}"
                                posted-on="{{ $post->created_at->diffForHumans() }}"
                                content="{{ $post->post_content }}"
                                wire-comment="textarea"
                                wire-submit="newComment('{{ $post->id }}')"
                                toggle-comment-section="toggleCommentSection('{{ $post->id }}')"
                                count-comments="{{ $comments->where('post_id', $post->id)->count() }}"
                                on-like="reaction('post', true, {{ $post->id }}, {{ $post->patient_user_id }}, '{{ $post->role }}', {{ $likes->where('post_comment_id', $post->id)->count() }}, {{ $adminId }}, '{{ $userRole }}')"
                                count-likes="{{ $likes->where('post_comment_id', $post->id)->where('post_type', 'post')->where('like_dislike', true)->count() }}"
                                on-dislike="reaction('post', false, {{ $post->id }}, {{ $post->patient_user_id }}, '{{ $post->role }}', {{ $likes->where('post_comment_id', $post->id)->count() }}, {{ $adminId }}, '{{ $userRole }}')"
                                count-dislikes="{{ $likes->where('post_comment_id', $post->id)->where('post_type', 'post')->where('like_dislike', false)->count() }}"
                            >

                            <x-slot name="more">
                                <x-atom.more id="post{{ $post->id }}">
                                    <x-atom.more.option wire-click="onShowModal('isEditPost', '{{ $post->id }}')" option-name="Edit"/>
                                    <x-atom.more.option wire-click="deletePost('{{ $post->id }}')" option-name="Delete"/>
                                </x-atom.more>
                            </x-slot>

                            </x-organisms.panel-settings.forum.forum-post>

                            @if($commentSectionIsOpen && $thisPost == $post->id)
                                <div id="{{ $post->id }}" class="forum_comments mt_20">
                                    <div class="relative pt_10">
                                        <div class="forum_comments_indicator absolute left top bottom pl_2" style="border-radius: 4px"></div>
                                        @foreach ($comments as $comment)
                                            @if($comment->post_id == $post->id)
                                                <x-organisms.panel-settings.forum.forum-post
                                                    post-type="comment"
                                                    id="{{ $comment->id }}"
                                                    current-user="{{ $adminId === $comment->patient_user_id && 'admin' === $comment->role ? 'accent_1' : '' }}" {{-- current logged in user--}}
                                                    name="{{ $comment->role == 'patient' ? $comment->patient->patient_fname . ' ' . $comment->patient->patient_mname . ' ' . $comment->patient->patient_lname : $comment->user->name }}"
                                                    posted-on="{{ $comment->created_at->diffForHumans() }}"
                                                    content="{{ $comment->comment_content }}"
                                                    wire-comment=""
                                                    wire-submit=""
                                                    toggle-comment-section=""
                                                    count-comments=""
                                                    on-like="reaction('comment', true, {{ $comment->id }}, {{ $comment->patient_user_id }}, '{{ $comment->role }}', {{ $likes->where('post_comment_id', $comment->id)->count() }}, {{ $adminId }}, '{{ $userRole }}')"
                                                    count-likes="{{ $likes->where('post_comment_id', $comment->id)->where('post_type', 'comment')->where('like_dislike', true)->count() }}"
                                                    on-dislike="reaction('comment', false, {{ $comment->id }}, {{ $comment->patient_user_id }}, '{{ $comment->role }}', {{ $likes->where('post_comment_id', $comment->id)->count() }}, {{ $adminId }}, '{{ $userRole }}')"
                                                    count-dislikes="{{ $likes->where('post_comment_id', $comment->id)->where('post_type', 'comment')->where('like_dislike', false)->count() }}"
                                                >

                                                <x-slot name="more">
                                                    <x-atom.more id="comment{{ $comment->id }}">
                                                        <x-atom.more.option wire-click="onShowModal('isEditComment', '{{ $comment->id }}')" option-name="Edit"/>
                                                        <x-atom.more.option wire-click="deleteComment('{{ $comment->id }}')" option-name="Delete"/>
                                                    </x-atom.more>
                                                </x-slot>

                                                </x-organisms.panel-settings.forum.forum-post>
                                            @endif                                        
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </x-organisms.panel-settings.forum.forum-container>
                    @endforeach
                
                <div class="fixed" style="right: 1em; bottom: 1em;">
                    <button wire:click.prevent="onShowModal('isNewPost', null)" class="btn_new_post overflow_hidden"><i class="fa-solid fa-pen"></i> <span class="ml_3">New Post</span></button>
                </div>
            </div>
           
            <br><br>

            @endif
    
            @if ($this->notif_isOpen)
                @section('title', 'Notifications')
                @section('desc', 'notification center')
            @endif
        </x-organisms.panel-settings>
    
    @endif


</div>




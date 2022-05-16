<div class="topbar flex flex_x_between flex_y_center" style="position:relative; background-color:transparent;">







    <div style="
        position: absolute; 
        top: 0.9em; 
        right: 1em;
        background-color: #ffffff;
        padding-top:0.2em;
        padding-bottom:0.2em;
        padding-right: 0.1em;
        padding-left: 1em;
        border-radius: 50px;
        display:flex;
        align-items:center;
        gap:1em;
        z-index:2;
        border:1px solid rgb(226, 226, 226);
        box-shadow: 0px 1.5px 3px rgba(0, 0, 0, 0.137);
    ">
        <small style="opacity:1">
            Today: {{ date('d') . ', ' . date('F') }}
        </small>


        <div style="position: relative;" x-data="{open:false}">
            <div @click="open= ! open" class="ui button circular secondary tiny icon" style="position:relative;">
                <i class="icon bell"></i>
                @if (count($notifications) > 0)
                    <small style="position: absolute; top:-3px; right:-3px; height:15px; width:15px; border-radius:50%; background:red; color:white;" class="x-flex x-flex-center">{{ count($notifications)}}</small>
                @endif
            </div>
            <div x-show="open" @click.outside="open = false" x-transition class="ui segment inverted" style="width:300px; max-width:300px; position: absolute; right:0; top:3em; padding:0; margin:0; box-shadow: 0px 7px 20px rgba(0, 0, 0, 0.274);">
                <div class="ui segment inverted noscroll" style="overflow-y:auto; max-height:500px; margin:0;">
                    @forelse ($notifications as $notif)
                        <div x-transition class="x-flex x-notification-panel" style="width: 100%; background-color:rgb(41, 41, 41); padding:0.7em; margin:7px 0;">
                            <div style="width: 100%;">
                                <span class="ui text grey" style="font-size:0.8rem; font-weight:bold;"><i class="icon bell"></i> {{ Str::upper($notif->title) }}</span>
                                <div>
                                    {{ $notif->desc }}
                                </div>
                                <div class="x-flex x-flex-xbetween x-flex-ycenter" style="padding-top:0.7em; width:100%;">
                                    <p style="opacity:1; font-size:0.8rem; margin:0;">
                                        <span class="ui text grey">{{ $notif->created_at->diffForHumans() }}</span>
                                    </p>
                                    <div class="x-flex x-gap-1 x-action-links">
                                        <a class="pointer" href="{{ $notif->link }}">View</a>
                                        <a wire:click.prevent="is_read({{ $notif->id }})" class="pointer">Close</a>

                                    </div>
                                </div>
                            </div>
                            {{-- <div style="padding-left:0.3em;">
                                <span wire:click.prevent="is_read({{ $notif->id }})"><i class="fa-solid fa-xmark pointer" style="color: red;"></i></span>
                            </div> --}}
                        </div>
                    @empty
                        <div style="padding: 15px 0">
                            <center>
                                <span class="ui text"><i class="icon smile wink outline"></i> No notifications so far.</span>
                            </center>
                        </div>
                    @endforelse
                </div>
                @if (count($notifications) > 0)
                    <div class="x-flex x-flex-xend" style="width: 100%; padding:0.7em 1em; box-shadow: 0px -14px 17px 0px rgba(0,0,0,0.48);">
                        <div>
                            <span wire:click.prevent="read_all" class="ui text blue pointer" style="font-size:0.9rem">Mark all as read</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        
        
        {{-- <div>
            <div class="ui dropdown floating mini circular secondary icon button" style="z-index: 1; position:relative;">
                <i class="bell icon"></i>
                <small style="position: absolute; top:-3px; right:-3px; height:15px; width:15px; border-radius:50%; background:red; color:white;" class="x-flex x-flex-center">7</small>
                <div class="menu inverted"  style="z-index: 1; width:300px; max-width:300px; white-space: normal;">
                    <div class="header">
                        <i class="bell icon"></i>
                        Notifications
                    </div>
                    <div class="scrolling menu inverted" style="z-index: 1; white-space:normal;">

                        <div class="item">
                            <div class="mb_5 x-flex">
                                <div style="white-space:normal; line-height:1.1rem;">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Esse ipsum, consequatur perspiciatis atque, culpa modi aliquam impedit consectetur omnis quis, adipisci ullam vero doloremque odit voluptatem reiciendis accusamus aut magni.
                                </div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}
    </div>








    
    {{-- <div style="
        position: absolute; 
        top: 0.9em; 
        right: 1em;
        background-color: white;
        padding-top:0.2em;
        padding-bottom:0.2em;
        padding-right: 0.1em;
        padding-left: 1em;
        border-radius: 50px;
        display:flex;
        align-items:center;
        gap:1em;
        z-index:2;
        border:1px solid rgb(226, 226, 226);
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.12);
    ">
        <small style="opacity:0.7">
            Today: {{ date('d') . ', ' . date('F') }}
        </small>
        <div>
            <div class="ui dropdown floating mini circular secondary icon button" style="z-index: 1; position:relative;">
                <i class="bell icon"></i>
                <small style="position: absolute; top:-3px; right:-3px; height:15px; width:15px; border-radius:50%; background:red; color:white;" class="x-flex x-flex-center">7</small>
                <div class="menu inverted"  style="z-index: 1; width:300px; max-width:300px; white-space: normal;">
                    <div class="header">
                        <i class="bell icon"></i>
                        Notifications
                    </div>
                    <div class="scrolling menu inverted" style="z-index: 1; white-space:normal;">

                        <div class="item">
                            <div class="mb_5 x-flex">
                                <div style="white-space:normal; line-height:1.1rem;">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Esse ipsum, consequatur perspiciatis atque, culpa modi aliquam impedit consectetur omnis quis, adipisci ullam vero doloremque odit voluptatem reiciendis accusamus aut magni.
                                </div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>
                        <div class="item">
                            <div class="x-flex x-flex-xbetween mb_5">
                                <div>Hello this is a notification</div>
                                <a>
                                    <i class="icon inverted red close"></i>
                                </a>
                            </div>
                            <span style="opacity: 0.5">2:56 am</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
































    {{-- <div class="flex flex_y_center">
            
    </div>
    <div>
        <span class="ui text blue">
            {{ date('d') . ', ' . date('F') }}
        </span>
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
                                current-user="{{ $adminId === $post->patient_user_id && 'admin' === $post->role ? 'accent_1' : '' }}" 
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
                                                    current-user="{{ $adminId === $comment->patient_user_id && 'admin' === $comment->role ? 'accent_1' : '' }}"
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
    
    @endif --}}


</div>




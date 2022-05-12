<x-layout.page-content>

    @section('section-page-title')
        {{-- <x-atoms.ui.header 
            title="Forum"
            desc="Lorem ipsum dolor sit amet"/> --}}
    @endsection

    @section('section-links')
    {{-- <div class="flex flex_x_center gap_1" style="width:100%;">
        <div style="margin-left:auto; margin-right:auto;">
            <div class="ui compact menu">
                <div class="link item @if ($subPage == 1) active @endif" wire:click.prevent="subPage(1)">
                    Forum
                </div>
                <div class="link item @if ($subPage == 2) active @endif" wire:click.prevent="subPage(2)">
                    Message
                </div>
                <div class="link item @if ($subPage == 3) active @endif" wire:click.prevent="subPage(3)">
                    Members
                </div>
            </div>
        </div>
    </div> --}}
    @endsection

    @section('section-heading-left')
        {{-- DFDF --}}
    @endsection

    @section('section-heading-right')
    @endsection

    @section('section-main')

        {{-- @switch($subPage)
            @case(1)
               --}}
                <div class="flex flex_x_center" style="position: relative; flex-direction:row-reverse; gap:2em;">


                    <div>
                        <div style="position:sticky; top:5em; width:200px;" x-data="{showPeople: true}">
                            <div class="ui relaxed aligned selection list">
                                <div class="item @if ($subPage == 1) active @endif" wire:click.prevent="subPage(1)">
                                    <div class="content">
                                        <i class="comments icon"></i> 
                                        Forum
                                        {{-- <div class="description">Updated 10 mins ago</div> --}}
                                    </div>
                                </div>
                                <div class="item @if ($subPage == 2) active @endif" wire:click.prevent="subPage(2)">
                                    <div class="content">
                                        <i class="comment icon"></i> 
                                        Messages
                                        {{-- <div class="description">Updated 22 mins ago</div> --}}
                                    </div>
                                </div>
                                <div class="ui divider"></div>
                                <div @click="showPeople = ! showPeople" class="item" :class="showPeople ? 'active' : ''">
                                    <div class="right floated content">
                                        <i :class="showPeople ? 'down' : 'up'" class="icon caret"></i>
                                    </div>
                                    
                                    <div class="content">
                                        <i class="users icon"></i> 
                                        Members <span style="opacity: 0.5; margin-left:0.3em;">({{ count(App\Models\Member::all()) }})</span>
                                        {{-- <div class="description">Updated 34 mins ago</div> --}}
                                        <div x-show="showPeople" x-transition>
                                            <br>
                                            @foreach (App\Models\Member::with('user')->get() as $member)
                                                <div class="flex gap_1" style="margin: 0.8em 0">
                                                    <div class="x-flex x-flex-ycenter">
                                                        <x-atom.profile-photo size="2.4em" path="{{ $this->storage($member->user->avatar) }}"/>
                                                    </div>
                                                    <div class="content" style="width:100%;">                                    
                                                        <div class="flex flex_x_between gap_1">
                                                            <div style="font-weight:bold">{{ $member->user->name}}</div>
                                                            {{-- <small style="opacity: 0.5; font-size:0.7rem;">Date joined: {{ $this->date($member->created_at) }} </small> --}}
                                                        </div>
                                                        <small class="text">
                                                            {{ $member->user->email }}
                                                        </small>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>






                @switch($subPage)
                    @case(1)


                    <div class="flex flex_column" style="max-width:400px; width:100%;" x-data="{createPost: @entangle('newPost')}">


                            <div class="flex flex_x_between flex_y_end py_7" x-bind:style="createPost && { display: 'none' }">
                                <div style="opacity:0.5">
                                    {{-- {{ $this->countPosts() }} --}}
                                </div>
                                <div>
                                    {{-- <button wire:click.prevent="$toggle('newPost')" class="ui button primary">
                                        <i class="edit icon"></i>
                                        Create Post
                                    </button> --}}
                                    <button @click="createPost = ! createPost" class="ui button icon primary">
                                        <i class="edit icon"></i>
                                        Create Post
                                    </button>
                                </div>
                            </div>



                            <form x-show="createPost" x-transition class="ui reply form" wire:submit.prevent="createPost">
                                <div class="field">
                                    <textarea wire:model.defer="postContent" placeholder="Write a post..." style="height:100px;"></textarea>
                                </div>
                                <div class="flex flex_x_end">
                                    <div class="mr_3">
                                        {{-- <button wire:click.prevent="$toggle('newPost')" class="ui button tiny basic">Cancel</button> --}}
                                        <button @click="createPost = false" class="ui button tiny basic">Cancel</button>
                                    </div>
                                    <div>
                                        <button type="submit" class="ui primary animated button tiny" tabindex="0">
                                            <div class="visible content">
                                                Post
                                            </div>
                                            <div class="hidden content">
                                                <i class="share icon"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="ui divider"></div>


                        {{-- @if ($newPost)  --}}
                            {{-- <form class="ui reply form" wire:submit.prevent="createPost">
                                <div class="field">
                                    <textarea wire:model.defer="postContent" placeholder="Write a post..." style="height:100px;"></textarea>
                                </div>
                                <div class="flex flex_x_end">
                                    <div class="mr_3">
                                        <button wire:click.prevent="$toggle('newPost')" class="ui button tiny basic">Cancel</button>
                                    </div>
                                    <div>
                                        <button type="submit" class="ui secondary animated button tiny" tabindex="0">
                                            <div class="visible content">
                                                Post
                                            </div>
                                            <div class="hidden content">
                                                <i class="right arrow icon"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <form wire:submit.prevent="uploadPhotos" action="">
                                <input wire:model="photos" type="file" name="" id="" placeholder="Add Photo" multiple>
                                <input type="submit" value="Submit">
                            </form> --}}
                        {{-- @else --}}

                        @if ($this->checkMember(Auth::user()->id))

                            @foreach ($posts as $post)        
                                {{ $post->id }}
                                <div id="{{ 'post_' . $post->id }}" class="" style="padding:1.5em; width:100%; margin:0.7em 0; border-radius:0.4em; -webkit-box-shadow: 0px 4px 14px -3px rgba(0,0,0,0.12); -moz-box-shadow: 0px 4px 14px -3px rgba(0,0,0,0.12); box-shadow: 0px 4px 14px -3px rgba(0,0,0,0.12);">
                                    <div class="flex flex_column gap_1">
                                        <div class="flex flex_x_between gap_1">
                                            <div class="flex gap_1">
                                                <div>
                                                    <x-atom.profile-photo size="40px" path="{{ $this->storage(Auth::user()->avatar) }}"/>
                                                </div>
                                                <div>
                                                    <div style="font-weight:bold;"><span class="@if($post->user_id == Auth::user()->id) ui text blue @endif">{{ $post->user->name }}</span></div>
                                                    <small style="opacity:0.5;">{{ $post->updated_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            <div>

                                                @if ($post->user_id == Auth::user()->id)
                                                    <x-atom.more>
                                                        <x-atom.more.option
                                                            wire-click="deletingPost({{ $post->id }})"
                                                            option-name="Delete" />
                                                    </x-atom.more>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="text">
                                            {{-- <div style="white-space: pre-wrap; font-family:Arial, Helvetica, sans-serif"> --}}
                                                {{ $post->post_content }}
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                    <div x-data="{openComment: false}" class="ui threaded comments">
                
                                        <div class="reaction flex flex_y_center gap_1">
                                            <span class="pointer ui button tiny fluid" wire:click.prevent="likePost({{ $post->id }}, {{ Auth::user()->id }})">
                                                <i class="@if($this->liked($post->id, Auth::user()->id, 1)) fa-solid @else fa-regular @endif fa-thumbs-up mr_2"></i>
                                                {{ $this->countPostLikes($post->id) }}
                                            </span>
                                            <span class="pointer ui button tiny fluid" @click="openComment = ! openComment">
                                                <i :class="openComment ? 'fa-solid' : 'fa-regular'" class=" fa-comment"></i>
                                                {{ $this->countPostComments($post->id) }}
                                            </span>
                                        </div>
                
                
                                        
                                        <div x-show="openComment" x-transition.scale.origin.bottom>
                                            <div style="margin-top:1em;">
                                                {{-- <div class="my_7">
                                                    <a @click="replyPost = ! replyPost" class="pointer">Add comment</a>
                                                </div> --}}
                                                <form @click.outside="replyPost = false" wire:submit.prevent="replyPost({{ $post->id }}, {{ Auth::user()->id }})" class="x-flex x-gap-1" style="width:100%;">
                                                    <div class="ui input" style="width:100%;">
                                                        <textarea class="ui input" wire:model.defer="commentContent" row="5" placeholder="Write a comment on this post..." style="height:4em; width:100%"></textarea>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="ui button basic icon tiny"><i class="icon share"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                            {{-- <div class="ui divider"></div> --}}
                                                @foreach ($comments->where('post_id', $post->id) as $comment)                        
                                                    {{ $comment->id }}
                                                    <div id="{{ 'comment_' . $comment->id }}" class="comment" style="margin:1.5em 0">
                                                        <a class="avatar">
                                                            <x-atom.profile-photo size="35px" path="{{ $this->storage($comment->user->avatar) }}"/>
                                                        </a>
                                                        <div class="content">
                                                            <div class="flex flex_x_between">
                                                                <div>
                                                                    {{-- <div> --}}
                                                                        <span style="font-weight: bold; @if($comment->user_id == Auth::user()->id) color:#2185d0; @endif">{{ $comment->user->name }}</span>
                                                                        <small style="opacity:0.5">
                                                                            {{-- <span class="date"> --}}
                                                                            {{ $comment->updated_at->diffForHumans() }}
                                                                            {{-- </span> --}}
                                                                        </small>
                                                                    {{-- </div> --}}
                                                                  
                                                                </div>
                                                                <div>
                                                                    @if ($comment->user_id == Auth::user()->id)
                                                                        <x-atom.more>
                                                                            <x-atom.more.option
                                                                                wire-click="deletingComment({{ $comment->id }})"
                                                                                option-name="Delete"/>
                                                                        </x-atom.more>
                                                                    @endif
                                                                </div>
                                                            </div>
                        
                                                            <div class="text">
                                                                {{-- <div style="white-space: pre-wrap; font-family:Arial, Helvetica, sans-serif"> --}}
                                                                    {{ $comment->comment_content }}
                                                                {{-- </div> --}}
                                                            </div>
                    
                                                            <div x-data="{comment_comment: false}">
                                                                <div class="reaction flex flex_y_center gap_1">
                                                                    <span class="pointer" wire:click.prevent="likeComment({{ $comment->id }}, {{ Auth::user()->id }}, 2)">
                                                                        <i class="@if($this->liked($comment->id, Auth::user()->id, 2)) fa-solid @else fa-regular @endif fa-thumbs-up mr_2"></i>
                                                                        {{ $this->countCommentLikes($comment->id, 2) }}
                                                                        {{-- <i class="fa-regular fa-thumbs-up mr_2"></i> 1   --}}
                                                                    </span>
                                                                    <span @click="comment_comment = ! comment_comment" class="pointer">
                                                                        <i :class="comment_comment ? 'fa-solid' : 'fa-regular'" class=" fa-comment"></i>
                                                                        {{ $this->countCommentComments($comment->id) }}
                                                                    </span>
                                                                </div>
                        
                                                                <div x-show="comment_comment">
                                                                    <div class="comments">
                                                                        <div class="mt_7 pointer">
                                                                            {{-- <a @click="replyComment = ! replyComment">Add Comment</a> --}}
                                                                            <form @click.outside="replyComment = false" wire:submit.prevent="replyComment({{ $comment->id }}, {{ Auth::user()->id }})" x-show="open" @click.outside="open= false" class="x-flex x-gap-1">
                                                                                <div class="ui input fluid" style="width:100%;">
                                                                                    <textarea wire:model.defer="commentContent" style="width:100%;" placeholder="Write your comment here..."></textarea>
                                                                                </div>
                                                                                <div>
                                                                                    <button type="submit" class="ui button basic icon tiny"><i class="icon share"></i></button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        {{-- <div class="ui divider"></div> --}}
                                                                        @foreach ($commentcomments->where('comment_id', $comment->id) as $commentcomment)
                                                                            <div class="comment" style="margin:1.5em 0;">
                                                                                <a class="avatar">
                                                                                    <x-atom.profile-photo size="35px" path="{{  $this->storage($commentcomment->user->avatar) }}"/>
                                                                                </a>
                                                                                <div class="content">
                                                                                    <div class="flex flex_x_between">
                                                                                        <div>
                                                                                            <a class="author">{{ $commentcomment->user->name }}</a>
                                                                                            <div class="metadata">
                                                                                                <span class="date">{{ $commentcomment->updated_at->diffForHumans() }}</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div>
                                                                                            <x-atom.more>
                                                                                                <x-atom.more.option
                                                                                                    wire-click="showModal('update', 'supplier', 'id')"
                                                                                                    option-name="Edit" />
                                                                                            </x-atom.more>
                                                                                        </div>
                                                                                    </div>
                    
                                                                                    <div class="text">
                                                                                        {{-- <div style="white-space: pre-wrap; font-family:Arial, Helvetica, sans-serif"> --}}
                                                                                            {{ $commentcomment->comment }}
                                                                                        {{-- </div> --}}
                                                                                    </div>
                    
                                                                                    <div class="pointer" wire:click.prevent="likeComment({{ $commentcomment->id }}, {{ Auth::user()->id }}, 3)">
                                                                                        <i class="@if($this->liked($commentcomment->id, Auth::user()->id, 3)) fa-solid @else fa-regular @endif fa-thumbs-up mr_2"></i>
                                                                                        {{ $this->countCommentLikes($commentcomment->id, 3) }}
                                                                                    </div>
                    
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>                                                                
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>                    
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            @endforeach


                            @if (count($posts) == $limit)
                                <center>
                                    <br>
                                    <a class="pointer ui button tertiary blue" wire:click.prevent="loadMore">Show more...</a>
                                </center>
                            @endif


                        @else
                                                    
                            <div class="ui blue left aligned message" style="width:100%; padding:1.5em;">
                                <div>
                                    <h3>Heads Up!</h3>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam rerum cumque non, tenetur, magni animi error velit assumenda itaque sequi repudiandae laudantium officiis. Vitae optio alias molestias earum libero laboriosam?</p>
                                </div>
                                <div class="" style="padding-top:1.5em;"> 
                                    <a wire:click.prevent="joinForum({{Auth::user()->id}})">Accept</a>
                                </div>
                            </div>


                        @endif
                    </div>
                @break


                @case(2)

                    <div class="flex flex_column" style="max-width:400px; width:100%;">
                        <div class="" style="padding:1.5em; width:100%; margin:0.7em 0; border-radius:0.4em; -webkit-box-shadow: 0px 4px 14px -3px rgba(0,0,0,0.12); -moz-box-shadow: 0px 4px 14px -3px rgba(0,0,0,0.12); box-shadow: 0px 4px 14px -3px rgba(0,0,0,0.12);">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsum debitis rerum tempora voluptates reprehenderit tenetur dolor beatae, pariatur necessitatibus omnis, earum, dignissimos ratione? Repellendus voluptate earum fugit repudiandae rerum sapiente.
                        </div>

                    </div>



                @break
                @endswitch
            </div>
        

{{-- 
            @case(2)
                <div class="flex flex_x_center">
                    <div class="flex flex_column" style="max-width:400px; width:100%;">
                        <div class="ui minimal comments">
                            
                                @if (Auth::user()->user_role == 3)

                                    <h3 class="ui dividing header">Conversation</h3>

                                    @error('body') <x-atoms.ui.validation id="body" message="{{ $message }}" header="Required"/> @enderror

                                    <form wire:submit.prevent="sendMessage({{ Auth::user()->id }}, 1)" class="ui reply form mb_15">
                                        <div class="field">
                                            <textarea wire:model.defer="body" style="height: 75px" rows="25" placeholder="White a message..."></textarea>
                                        </div>
                                        <div class="flex flex_x_end">
                                            <button type="submit" class="ui blue button tiny">Post</button>
                                        </div>
                                    </form>

                                    <div style="max-height:500px; overflow-y:auto;">
                                        @foreach ($this->displayMessage(Auth::user()->id) as $message)

                                            <div class="comment">
                                                <a class="avatar">
                                                    <x-atom.profile-photo size="33px" path="{{ $this->storage($message->user->avatar) }}"/>
                                                </a>
                                                <div class="content">
                                                    <a class="author">{{ $message->user->id == Auth::user()->id ? 'You' : $message->user->name }}</a>
                                                    <div class="metadata">
                                                        <span class="date">{{ $message->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <div class="text">
                                                        {{ $message->body }}
                                                    </div>
                                                </div>
                                            </div>
        
                                        @endforeach
                                    </div>

                                @endif
    
                                @if (Auth::user()->user_role == 1)
                                    @if ($patient > 0)
                                        <h3 class="ui dividing header"> <i wire:click.prevent="$set('patient', 0)" class="fa-solid fa-arrow-left mr_3"></i> Conversation</h3>

                                        @error('body') <x-atoms.ui.validation id="body" message="{{ $message }}" header="Required"/> @enderror

                                        <form wire:submit.prevent="sendMessage({{ Auth::user()->id }}, {{ $patient }})" class="ui reply form mb_15">
                                            <div class="field">
                                                <textarea wire:model.defer="body" style="height: 75px" rows="25" placeholder="White a message..."></textarea>
                                            </div>
                                            <div class="flex flex_x_end">
                                                <button type="submit" class="ui blue button tiny">Post</button>
                                            </div>
                                        </form>

                                        <div style="max-height:500px; overflow-y:auto;">
                                            @foreach($this->displayMessage($patient) as $conversation)

                                                <div class="comment">
                                                    <a class="avatar">
                                                        <x-atom.profile-photo size="33px" path="{{ $this->storage($conversation->user->avatar) }}"/>
                                                    </a>
                                                    <div class="content">
                                                        <a class="author">{{ $conversation->user->id == Auth::user()->id ? 'You' : $conversation->user->name }}</a>
                                                        <div class="metadata">
                                                            <span class="date">{{ $conversation->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <div class="text">
                                                            {{ $conversation->body }}
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        </div>
                                    @else
                                        <h3 class="ui dividing header">Messages</h3>
                                        <div class="flex flex_column gap_1">

                                            @foreach ($chatrooms as $room)
                                                    <div class="flex gap_1" wire:click.prevent="$set('patient', {{ $room->user->id }})">
                                                        <div class="avatar">
                                                            <x-atom.profile-photo size="2.8em" path="{{ $this->storage($room->user->avatar) }}"/>
                                                        </div>
                                                        <div class="content" style="width:100%;">                                    
                                                            <div class="flex flex_x_between gap_1">
                                                                <div style="font-weight:bold">{{ $room->user->name }}</div>
                                                                <small style="opacity: 0.5;">{{ $room->updated_at->diffForHumans() }} </small>
                                                            </div>
                                                            <div>
                                                                {{ $room->new_message > 0 ? $room->new_message . ' new messages' : App\Models\Message::where('sender_id', $room->user->id)->latest()->first()->body }}
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endforeach

                                        </div>
                                    @endif
                                @endif

                        </div>
                    </div>
                </div>
                @break

            @case(3)
                <div class="flex flex_x_center">
                    <div class="flex flex_column" style="max-width:400px; width:100%;">
                        <div class="ui minimal comments">

                            <h3 class="ui dividing header">{{ $this->countMembers() }}</h3>                    

                            
                            <div class="flex flex_column gap_1">
                                
                                @foreach (App\Models\Member::with('user')->get() as $member)
                                    <div class="flex gap_1">
                                        <div class="avatar">
                                            <x-atom.profile-photo size="2.8em" path="{{ $this->storage($member->user->avatar) }}"/>
                                        </div>
                                        <div class="content" style="width:100%;">                                    
                                            <div class="flex flex_x_between gap_1">
                                                <div style="font-weight:bold">{{ $member->user->name}}</div>
                                                <small style="opacity: 0.5; font-size:0.7rem;">Date joined: {{ $this->date($member->created_at) }} </small>
                                            </div>
                                            <small class="text">
                                                {{ $member->user->email }}
                                            </small>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                @break

            @default
                
        @endswitch
     --}}
   
    @endsection

</x-layout.page-content>


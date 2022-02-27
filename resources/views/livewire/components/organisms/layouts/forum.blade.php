<x-organisms.panel-settings title="Forum" wire-toggle="forumWindow_IsOpen">
    <div class="forum_container">
            
        @foreach ($posts as $post)

            @if ($post->role == 'patient')

                <x-organisms.panel-settings.forum.forum-container>
                    <x-organisms.panel-settings.forum.forum-post
                        post-type="post"
                        id="{{ $post->id }}"
                        posted-on="{{ $post->created_at->diffForHumans() }}"
                        content="{{ $post->post_content }}"
                        name="{{ $post->patient->patient_fname . ' ' . $post->patient->patient_mname . ' ' . $post->patient->patient_lname }}"
                        wire-comment="userComment"
                        wire-submit="createComment('{{ $post->id }}')"
                    >
                        {{ $comments->where('post_id', $post->id)->count() }}
                    </x-organisms.panel-settings.forum.forum-post>
                    <div id="{{ $post->id }}" class="forum_comments nodisplay">
                        <div class="relative py_10">
                            <div class="forum_comments_indicator absolute left top bottom pl_1" style="border-radius: 4px"></div>
                               
                                @forelse ($comments as $comment)
                                    @if($comment->post_id == $post->id)
                                        @if($comment->role == 'patient')
                                            <x-organisms.panel-settings.forum.forum-post
                                                post-type="comment"
                                                id="{{ $comment->id }}"
                                                posted-on="{{ $comment->created_at->diffForHumans() }}"
                                                content="{{ $comment->comment_content }}"
                                                name="{{ $comment->patient->patient_fname . ' ' . $comment->patient->patient_mname . ' ' . $comment->patient->patient_lname }}"
                                                wire-comment=""
                                                wire-submit=""
                                            />
                                        @endif
                                        @if($comment->role == 'admin')
                                            <x-organisms.panel-settings.forum.forum-post
                                                post-type="comment"
                                                id="{{ $comment->id }}"
                                                posted-on="{{ $comment->created_at->diffForHumans() }}"
                                                content="{{ $comment->comment_content }}"
                                                name="{{ $comment->user->name }}"
                                                wire-comment=""
                                                wire-submit=""
                                            />
                                        @endif
                                    @endif
                                @empty
                                    
                                @endforelse
                        </div>
                    </div>
                </x-organisms.panel-settings.forum.forum-container>
            @endif
            @if ($post->role == 'admin')
                <x-organisms.panel-settings.forum.forum-container>
                    <x-organisms.panel-settings.forum.forum-post
                        post-type="post"
                        id="{{ $post->id }}"
                        posted-on="{{ $post->created_at->diffForHumans() }}"
                        content="{{ $post->post_content }}"
                        name="{{ $post->user->name }}"
                        wire-comment="userComment"
                        wire-submit="createComment('{{ $post->id }}')"
                    >
                        {{ $comments->where('post_id', $post->id)->count() }}
                    </x-organisms.panel-settings.forum.forum-post>
                    <div id="{{ $post->id }}" class="forum_comments nodisplay">
                        <div class="relative py_10">
                            <div class="forum_comments_indicator absolute left top bottom pl_1" style="border-radius: 4px"></div>
                        
                                @forelse ($comments as $comment)
                                    @if($comment->post_id == $post->id)
                                        @if($comment->role == 'patient')
                                            <x-organisms.panel-settings.forum.forum-post
                                                post-type="comment"
                                                id="{{ $comment->id }}"
                                                posted-on="{{ $comment->created_at->diffForHumans() }}"
                                                content="{{ $comment->comment_content }}"
                                                name="{{ $comment->patient->patient_fname . ' ' . $comment->patient->patient_mname . ' ' . $comment->patient->patient_lname }}"
                                                wire-comment=""
                                                wire-submit=""
                                            />
                                        @endif
                                        @if($comment->role == 'admin')
                                            <x-organisms.panel-settings.forum.forum-post
                                                post-type="comment"
                                                id="{{ $comment->id }}"
                                                posted-on="{{ $comment->created_at->diffForHumans() }}"
                                                content="{{ $comment->comment_content }}"
                                                name="{{ $comment->user->name }}"
                                                wire-comment=""
                                                wire-submit=""
                                            />
                                        @endif
                                    @endif
                                @empty
                                @endforelse
                        </div>
                    </div>
                </x-organisms.panel-settings.forum.forum-container>
            @endif

        @endforeach
        
    </div>

</x-organisms.panel-settings>
<div class="topbar flex flex_x_between flex_y_center">
    <div class="flex flex_y_center">
        <span class="mr_10" style="display: none">
            <i class="fas fa-bars"></i>
        </span>
        <h5 class="uppercase" style="letter-spacing: 0.1rem">
            {{-- @yield('pageTitle') --}}
        </h5>
    </div>
    <div class="flex gap_1">
        <div>
            {{-- <i onclick="document.getElementById('forum_container').style.display = 'block'" class="fa-solid fa-comment"></i> --}}
            <i wire:click="$toggle('forumWindow_IsOpen')" class="fa-solid fa-comment"></i>
        </div>
        <div>
            <i class="fas fa-bell"></i>
        </div>
    </div>
</div>





@if ($this->forumWindow_IsOpen)
    
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
                        />
                        <div id="{{ $post->id }}" class="forum_comments nodisplay">
                            <div class="relative py_10">
                                <div class="forum_comments_indicator absolute left top bottom pl_1" style="border-radius: 4px"></div>
                            
                                {{-- @for ($j=0; $j<6; $j++)
                                    <x-organisms.panel-settings.forum.forum-post
                                        id="{{ $j }}"
                                        post-type="comment"
                                    />
                                @endfor --}}

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
                        />
                        <div id="{{ $post->id }}" class="forum_comments nodisplay">
                            <div class="relative py_10">
                                <div class="forum_comments_indicator absolute left top bottom pl_1" style="border-radius: 4px"></div>
                            
                                {{-- @for ($j=0; $j<6; $j++)
                                    <x-organisms.panel-settings.forum.forum-post
                                        id="{{ $j }}"
                                        post-type="comment"
                                    />
                                @endfor --}}

                            </div>
                        </div>
                    </x-organisms.panel-settings.forum.forum-container>
                @endif

            @endforeach
            
        </div>

    </x-organisms.panel-settings>
@endif
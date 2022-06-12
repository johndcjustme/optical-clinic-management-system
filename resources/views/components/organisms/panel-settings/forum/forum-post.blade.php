@php
    if($postType === 'post') {
        $optionId = 'post';
    }
    if($postType === 'comment') {
        $optionId = 'comment';
    }
@endphp


<div class="grid grid_col_2 {{ $postType === 'comment' ? 'ml_2' : '' }}" style="grid-template-columns: 40px auto">
    <div class="flex flex_x_end" style="height: 40px">
        <div class="photo" 
            style="
                @if($postType === 'post')
                    height: 40px;
                    width: 40px;
                @endif
                @if($postType === 'comment')
                    height: 30px;
                    width: 30px;
                    margin-top: 5px;
                @endif
                border-radius: 50%;
                background: rgb(182, 182, 182)
                ">
        </div>
    </div>
    <div class="pl_8 {{ $postType == 'comment' ? 'bb_1 pb_9 mb_9 ' : '' }}">
        <div class="flex flex_x_between flex_y_center" style="height: 40px">
            <div>
                <p class="dark_200 {{ $currentUser }}" style="font-size: 0.75rem;"><b>{{ $name }}</b></p>
                <p class="dark_200 mt_2" style="font-size: 0.7rem">{{ $postedOn }}</p>
            </div>
            <div> 
                
                {{ $more }}

            </div>
        </div>
        <div class="mt_10 mb_15">
            <p class="">
                {{ $content }}
            </p>
        </div>

        @if ($postType === 'post')
            <form wire:submit.prevent="{{ $wireSubmit }}">
                <div class="flex flex_x_between flex_y_start m_0"> 
                    <div class="write_comment full_w">
                        <textarea wire:model.defer="{{ $wireComment }}" type="text" placeholder="Your comment..." class="overflow_hidden" rows="1" style="margin: 0; height:auto" required></textarea></div>
                    <div class="ml_10">
                        <button class="noformat mt_3" type="submit" style="font-size: 0.75rem; color: #2B4FFF;">SEND</button>
                    </div>
                </div>
            </form>
        @endif
        <div class="mt_12 full_w noselect flex flex_y_center font_s gap_1">
            {{-- <div> --}}
                <span wire:click="{{ $toggleCommentSection }}" class="nodecoration font_s pointer dark_400 {{ $postType === 'post' ? '' : 'nodisplay' }}"><i class="fa-regular fa-comment-dots mr_1"></i> <b>{{ $countComments }}</b></span>
            {{-- </div> --}}
            {{-- <div class="flex flex_y_center gap_1"> --}}
                <span wire:click="{{ $onLike }}" class="nodecoration font_s pointer dark_100"><i class="fa-regular fa-thumbs-up"></i> <b>{{ $countLikes }}</b></span>
                <span wire:click="{{ $onDislike }}" class="nodecoration font_s pointer dark_100"><i class="fa-regular fa-thumbs-down"></i> <b>{{ $countDislikes }}</b></span>
            {{-- </div> --}}
        </div>
    </div>
</div>


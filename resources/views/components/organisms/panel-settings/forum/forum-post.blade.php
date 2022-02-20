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
                background: rgb(182, 182, 182)"
                >
        </div>
    </div>
    <div class="pl_8">
        <div class="flex flex_x_between flex_y_center" style="height: 40px">
            <div>
                <p style="font-size: 0.8rem"><b>{{ $name }}</b></p>
                <p style="font-size: 0.7rem">{{ $postedOn }}</p>
            </div>
            <div>
                <div class="relative">
                    <div class="flex flex_x_end">
                        <i onclick="document.getElementById('option{{ $optionId . $id }}').style.display = 'block'" class="fa-solid fa-ellipsis-vertical px_2"></i>
                    </div>
                    <div id="option{{ $optionId . $id }}" class="forum_post_option absolute p_8 flex" style="top: -1em; right: -0.7em; background:white; display:none;">
                        <div class="flex">
                            <div class="pointer pt_3" style="font-size: 0.8rem">
                                <div class="mb_4">Edit</div>
                                <div>Delete</div>
                            </div>
                            <div class="ml_3">
                                <i onclick="document.getElementById('option{{ $optionId . $id }}').style.display = 'none'" class="fas fa-close"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="my_7">
            <p>
                {{ $content }}
            </p>
        </div>

        @if ($postType === 'post')
            <div class="flex flex_x_between flex_y_start gap_1 m_0"> 
                <div class="write_comment">
                    <textarea type="text" placeholder="Your comment..." class="overflow_hidden" rows="1" style="margin: 0; height:auto"></textarea></div>
                <div>
                    <a href="#" class="send text_btn nodecoration" style="color: #2B4FFF; font-size: 0.7rem; font-weight:bold;">SEND</a>
                </div>
            </div>
            <div class="mt_7">
                <a href="#" onclick="document.getElementById('{{ $id }}').classList.toggle('nodisplay')" class="nodecoration font_s">6 comments ...</a>
            </div>
        @endif
        @if ($postType === 'comment')
            <div class="bt_1 my_10"></div>
        @endif
    </div>
</div>




<script>

    var textarea = document.querySelector('textarea');
    var i;

    textarea.addEventListener('keydown', autosize);
                
    function autosize(){
    var el = this;
    setTimeout(function(){
        el.style.cssText = 'height:auto; padding:0';
        // for box-sizing other than "content-box" use:
        // el.style.cssText = '-moz-box-sizing:content-box';
        el.style.cssText = 'height:' + el.scrollHeight + 'px';
    },0);
    }


</script>
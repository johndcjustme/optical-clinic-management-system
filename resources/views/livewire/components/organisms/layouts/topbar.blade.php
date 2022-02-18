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
            <i onclick="document.getElementById('forum_container').style.display = 'block'" class="fa-solid fa-comment"></i>
        </div>
        <div>
            <i class="fas fa-bell"></i>
        </div>
    </div>
</div>





<div id="forum_container" class="forum_container fixed top left bottom right flex flex_x_center p_15 full_vh" style="padding-top: 50px; display:none">
    <i onclick="document.getElementById('forum_container').style.display = 'none'" class="fa-solid fa-xmark fixed top" style="font-size: 1.5em; right: 48%; top: 10px; color:white"></i>
    <div class="forum_content full_h overflow_hidden relative" style="background: white;">
        <div class="patient_names_container overflow_y noscroll" style="height: auto">
            <div class="" style="margin: 30px 0;">
                @for ($i=0; $i<20; $i++)
                    <div class="patient_name grid overflow_hidden pointer" style="padding: 1em 0.2em; height: 5em; grid-template-columns: 3em auto; gap: 0.5em">
                        <div class="flex flex_center">
                            <div style="background: pink; height: 3em; width: 3em; border-radius: 50%;"></div>
                        </div>
                        <div class="flex flex_column flex_x_center"> 
                            <div class="name" style="">John De Castro</div>
                            <div class="" style=""><p style="white-space: nowrap">Lorem ipsum dolor sit amet.</p></div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <div id="patient_chats_container" class="patient_chats_container overflow_hidden full_h flex flex_column flex_x_between grid" style="grid-template-rows: auto auto; background: rgb(233, 233, 233);">
            <div id="chat_content" class="overflow_y">
                @for ($i=0; $i<20; $i++)

                    <div class="m_4 mb_10 flex flex_x_start" style="height: auto;">
                        <div class="chat px_5 py_10" style="max-width: 80%; background:rgb(255, 255, 255); border-bottom-right-radius: 1em; border-top-left-radius: 1em; border-top-right-radius: 1em;">
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, quod! Quam est facere officiis atque nostrum ex optio incidunt sit.
                            </p>
                        </div>
                    </div>
                    <div class="m_4 mb_10 flex flex_x_end" style="height: auto;">
                        <div class="chat px_5 py_10" style="max-width: 80%; background:#2B4FFF; border-bottom-left-radius: 1em; border-top-left-radius: 1em; border-top-right-radius: 1em;">
                            <p style="color:white;">
                                Lorem ipsum dolor sit amet.
                            </p>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="grid" style="grid-template-columns: auto 7em; background-color:white">
                <div>
                    <textarea name="" id="" cols="30"style="height: 98%"></textarea>
                </div>
                <div class="flex flex_center">
                    <label for="">SEND</label>
                    <button class="full_w" hidden>Send</button>
                </div>
            </div>
        </div>
        <div class="patients_button relative">
            <i class="fa-solid fa-caret-right absolute" style="right:0.9em; top:40%;"></i>
        </div>
    </div>

</div>



<script>
    $('#chat_content').scrollTop($('#chat_content')[0].scrollHeight);
</script>
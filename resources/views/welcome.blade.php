@includeIf('layouts.head')

<style>
    .welcome_container > div {
        padding: 0 17%;
    }
</style>

<div class="welcome_container full_vh full_w overflow_hidden" style="display:grid; grid-template-columns: 100vw; grid-template-rows: 4em auto">
    <div class="py_5 flex flex_y_center flex_x_between">
        {{-- <div> --}}
            <img src="{{ asset('images/dango-logo-nolabel.png')}}" height="80%" alt="">
        {{-- </div> --}}
        <div class="flex flex_y_center gap_1">
            <div>
                <p onclick="location.assign('/login')">SIGN IN</p>
            </div>
            <div>
                <button style="background: transparent; border:1px solid #004FC6; color:#004FC6; border-radius: 3em; padding-left: 1.3em; padding-right: 1.3em;"><i class="fa-solid fa-calendar-check mr_3"></i> BOOK NOW</button>
            </div>
        </div>
    </div>
    <div style="display: grid; grid-template-columns: 50% 50%">
        <div class="flex flex_y_center">
            <div class="relative">
                <div>
                    <div>
                        <p class="" style="color: #004FC6;letter-spacing:0.2rem; font-weight:normal; font-size:1.2rem; margin-bottom: -0.2em">DANGO OPTICAL CLINIC</p>
                        <h1 style="line-height: 0.9em; font-size: 3.8rem;">
                            <span class="" style="color: #004FC6;"><span class="dark_400">SEE</span> CLEAR.</span><br>
                            <span class="" style="color: #004FC6;"><span class="dark_400">SEE</span> BETTER.</span>
                        </h1>
                    </div>
                    <div style="margin-top: 4em">
                        <p><i class="fa-solid fa-angle-right mr_5"></i> About Us</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex_y_center flex_x_end full_h">
            {{-- <div class="absolute bottom right" style=""> --}}
                <div class="relative">
                    <img class="" src="{{ asset('images/landing-image.png') }}" height="500px" alt="" style="z-index: 10">
                    <div class="absolute bottom right" style="background: rgba(0, 0, 0, 0.274); height: 20px; width: 200px; z-index:-10; margin-right: 80px; border-radius: 50%; box-shadow: 0 0px 50px rgba(0, 0, 0, 0.651)"></div>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>

@includeIf('layouts.head')

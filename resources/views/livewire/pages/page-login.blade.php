<div class="full_vh full_vw flex flex_center bg_light_200">
    <div class="card animate_opacity overflow_hidden" style="max-width: 250px;">
        <div class="mb_10 animate_left">
            <img onclick="location.assign('/')" src="{{ asset('images/dango-logo-nolabel.png')}}" height="75px" alt="">
        </div>
        <div class="animate_opacity">
            <h4 style="font-weight: normal">Welcome back</h4><br>
        </div>
        <form action="/dashboard">
            <input class="animate_left" type="text" placeholder="Username" style="letter-spacing: 0.1rem">
            <input class="animate_right" type="password" placeholder="Password" style="letter-spacing: 0.1rem">
            <div class="flex flex_y_center flex_x_between mt_10">
                <div class="animate_left">
                    <p class="font_medium">Forgot Password?</p>
                </div>
                <div class="animate_right">
                    <button>Sign in</button>
                </div>
            </div>
        </form>
    </div>
</div>
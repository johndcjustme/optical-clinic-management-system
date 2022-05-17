@includeIf('layouts.head')
<div class="pushable">


    <!-- Following Menu -->
    <div class="ui large top fixed hidden menu">
        <div class="ui container">
            <img src="{{ asset('images/dango-logo-nolabel.png')}}" alt="" width="60px" style="padding: 0.8em;">

            {{-- <a class="active item">Home</a>
            <a class="item">Work</a>
            <a class="item">Company</a>
            <a class="item">Careers</a> --}}
            <div class="right menu">
                <div class="item">
                    <a class="ui button">Log in</a>
                </div>
                <div class="item">
                    <a class="ui primary button">Sign Up</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <div class="ui vertical inverted sidebar menu left">
        <img src="{{ asset('images/dango-logo-nolabel.png')}}" alt="" width="60px" style="padding: 0.8em;">
        <a class="active item">Home</a>
        <a class="item">Work</a>
        <a class="item">Company</a>
        <a class="item">Careers</a>
        <a class="item">Login</a>
        <a class="item">Signup</a>
    </div>


    <!-- Page Contents -->
    <div class="pusher">
        <div class="ui inverted vertical masthead center aligned segment" {{--style="background: url('images/bbackground.png') no-repeat center top; background-size: cover" --}}>

            <div class="ui container">
                <div class="ui large secondary inverted pointing menu">
                    <a class="toc item">
                        <i class="sidebar icon"></i>
                    </a>
                    <img class="item" src="{{ asset('images/dango-logo-nolabel.png')}}" alt="" width="60px" style="padding: 0.8em;">
                    {{-- <a class="active item">Home</a>
                    <a class="item">Work</a>
                    <a class="item">Company</a>
                    <a class="item">Careers</a> --}}
                    <div class="right item">
                        <a href="/login" class="ui inverted button">Log in</a>
                        {{-- <a href="/register" class="ui inverted button">Sign Up</a> --}}
                    </div>
                </div>
            </div>

            <div class="ui text container" >
                <h1 class="ui inverted header">
                    Dango Optical Clinic
                </h1>
                <h2 style="margin:1em 0; color: rgb(236, 236, 236)">See clear. See better.</h2>
                <a href="{{ route('register') }}" class="ui huge primary button">Book Now <i class="right arrow icon"></i></a>
            </div>

        </div>

        <div class="ui vertical stripe segment">
            <div class="ui middle aligned stackable grid container">
                <div class="row">
                    <div class="eight wide column">

                        <h3 class="ui header">Making Your Face Stylish</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque minus placeat dolores rem fuga quidem, tempore expedita veritatis, quasi quas aliquam error aut impedit. Molestiae voluptatem hic velit laborum beatae?</p>
                        <h3 class="ui header">View More at Another Perspective</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad voluptatibus magnam facere, dicta tempore laboriosam!
                        </p>
                    </div>
                    <div class="six wide right floated column">
                        <img src="images/sample.png" class="ui large bordered rounded image">
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="center aligned column">
                        <a class="ui huge button">Check Them Out</a>
                    </div>
                </div> --}}
            </div>
        </div>


        <div class="ui vertical stripe quote segment">
            <div class="ui equal width stackable internally celled grid">
                <div class="center aligned row">
                    <div class="column">
                        <h3>"What a Company"</h3>
                        <p>That is what they all say about us</p>
                    </div>
                    <div class="column">
                        <h3>"I shouldn't have gone with their competitor."</h3>
                        <p>
                            <img src="images/john-profile2.png" class="ui avatar image"> <b>John Dc</b> Chief Fun Officer
                            Acme Toys
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui vertical stripe segment">

            <div class="ui text container">
                <h3 class="ui header">Our Location</h3>
                <p>Moonglow Bldg., Brgy. Bagong Lungsod, Tandag City, Bayan ng Tandag, Surigao del Sur, Philippines.</p>
                <br>
                {{-- <a class="ui large button">Read More</a> --}}
                {{-- <h4 class="ui horizontal header divider">
                    <a href="#">Case Studies</a>
                </h4> --}}
                <div class="ui segment">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d984.9695105353788!2d126.19760723913434!3d9.074873811599314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33023722aa2d8ddd%3A0x400fd0a0bc1620f2!2sDango%20Optical%20%26%20Dental%20Clinic!5e0!3m2!1sen!2sph!4v1650108857424!5m2!1sen!2sph" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <br>
                <h3 class="ui header">About Us</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui iure error illum nisi alias aspernatur sequi neque corrupti deserunt esse cupiditate culpa aperiam in, totam aut debitis eveniet minima architecto!</p>
                <a class="ui large button">More about us</a>
            </div>
        </div>


        <div class="ui inverted vertical footer segment">
            <div class="ui container">
                <div class="ui stackable inverted divided equal height stackable grid">
                    <div class="three wide column">
                        <h4 class="ui inverted header">About</h4>
                        <div class="ui inverted link list">
                            <a href="#" class="item">Sitemap</a>
                            <a href="#" class="item">Contact Us</a>
                            <a href="#" class="item">Religious Ceremonies</a>
                            <a href="#" class="item">Gazebo Plans</a>
                        </div>
                    </div>
                    <div class="three wide column">
                        <h4 class="ui inverted header">Services</h4>
                        <div class="ui inverted link list">
                            <a href="#" class="item">Optometrist</a>
                            <a href="#" class="item">Dentist & Dental Office</a>
                        </div>  
                    </div>
                    <div class="seven wide column">
                        <h4 class="ui inverted header">You can reach us on</h4>
                        {{-- <p>Extra space for a call to action inside the footer that could help re-engage users.</p> --}}
                        <div class="ui inverted link list">
                            {{-- <a href="#" class="item"><i class="fa-solid fa-user-tie mr_3"></i> Optometrist · Dentist & Dental Office</a> --}}
                            <a href="#" class="item"><i class="fa-brands fa-facebook mr_3"></i> Facebook</a>
                            <a href="#" class="item"><i class="fa-brands fa-facebook-messenger mr_3"></i> Messenger</a>
                            <a href="#" class="item"><i class="fa-solid fa-phone mr_3"></i> 0910 716 3830</a>
                            
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
























{{-- <style>
    .welcome_container > div {
        padding: 0 17%;
    }
</style>

<div class="welcome_container full_vh full_w overflow_hidden" style="display:grid; grid-template-columns: 100vw; grid-template-rows: 4em auto">
    <div class="py_5 flex flex_y_center flex_x_between">
            <img src="{{ asset('images/dango-logo-nolabel.png')}}" height="80%" alt="">
        <div class="flex flex_y_center gap_1">
            <div>
                <a href="#" onclick="location.assign('/login')"><span class="ui text blue">SIGN IN</span></a>
            </div>
            <div>
                <button onclick="window.location.assign('/register')" class="ui button primary"><i class="fa-solid fa-calendar-check mr_3"></i> BOOK NOW</button>
            </div>
        </div>
    </div>
    <div style="display: grid; grid-template-columns: 50% 50%">
        <div class="flex flex_y_center">
            <div class="relative">
                <div>
                    <div>
                        <p class="" style="letter-spacing:0.2rem; font-weight:normal; font-size:1.2rem; margin-bottom: -0.2em"><span class="ui text blue">DANGO OPTICAL CLINIC</span></p>
                        <h1 style="line-height: 0.9em; font-size: 3.8rem;">
                            <span class="ui text blue"><span class="dark_400">SEE</span> CLEAR.</span><br>
                            <span class="ui text blue"><span class="dark_400">SEE</span> BETTER.</span>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex_y_center flex_x_end full_h">
                <div class="relative">
                    <img class="" src="{{ asset('images/landing-image.png') }}" height="500px" alt="" style="z-index: 10">
                    <div class="absolute bottom right" style="background: rgba(0, 0, 0, 0.274); height: 20px; width: 200px; z-index:-10; margin-right: 80px; border-radius: 50%; box-shadow: 0 0px 50px rgba(0, 0, 0, 0.651)"></div>
                </div>
        </div>
    </div>
</div> --}}

</div>


@includeIf('layouts.head')

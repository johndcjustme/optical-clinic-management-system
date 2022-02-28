<section class="section_sidenav full_vh overflow_y noscroll">

    
    <ul class="selectable p_7 empty">
        <div class="mt_10 mb_10 overflow_hidden" style="">
            <img src="{{ asset('images/dango-logo-nolabel.png') }}" alt="" width="40px" height="auto">
            {{-- <div class="flex flex_center text_left mt_7">
                <div class="flex flex_center">
                </div>
                <span class="mt_6 flex flex_y_center text_left" style="line-height: 1rem; width:auto;">
                    <b style="font-size: 1.3rem;">DANGO</b>                        
                    <span style="font-size: 0.6rem;">OPTICAL CLINIC</span>
                </span>
            </div> --}}
        </div>
        <hr class="my_10">
        <div>
            {{-- <p class="light_500 font_bold font_s">NAVIGATION</p>
            <hr class="mb_10"> --}}
            <a href="/dashboard" title="Dashboard">
                <li class="@yield('dashboard')">
                    <i class="fas fa-chart-area"></i>
                    <span>Dashboard</span>
                </li>
            </a>
            <a href="/patients" title="Patient">
                <li class="@yield('patients')">
                    <i class="fas fa-user-friends"></i>
                    <span>Patients</span>
                </li>
            </a>
            <a href="/inventory" title="Inventory">
                <li class="@yield('inventory')">
                    <i class="fas fa-boxes"></i>
                    <span>Inventory</span>
                </li>
            </a>
            <a href="/orders" title="Orders">
                <li class="@yield('orders')">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </li>
            </a>
            <a href="/appointments" title="Appointments">
                <li class="@yield('appointments')">
                    <i class="fas fa-calendar-check"></i>
                    <span>Appointments</span>
                </li>
            </a>
            <a href="/users" title="User">
                <li class="@yield('users')">
                    <i class="fas fa-smile"></i>
                    <span>Users</span>
                </li>
            </a>
        </div>
        
        {{-- footer  --}}
        <div>
            <hr class="my_10">
            <a href="/login" title="Logout">
                <li>
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </li>
            </a>
        </div>
    </ul>
</section>

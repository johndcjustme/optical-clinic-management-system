<section class="section_sidenav full_vh overflow_y noscroll">

    
    <ul class="selectable p_7 empty">
        <div>
            <div class="flex flex_center text_left mt_7">
                <div class="flex flex_center">
                    <img src="{{ asset('images/dango-logo-nolabel.png') }}" alt="" style="width:60%">
                </div>
                <span class="mt_6 flex flex_y_center text_left" style="line-height: 1rem; width:auto;">
                    <b style="font-size: 1.3rem;">DANGO</b>                        
                    <span style="font-size: 0.6rem">OPTICAL CLINIC</span>
                </span>
            </div>
        </div>
        <br><br>
        <div>
            <hr class="mb_10">
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
                    <span>My Account</span>
                </li>
            </a>
        </div>
        
        {{-- footer  --}}
        <div>
            <hr class="my_10">
            <a href="/sign-in" title="Logout">
                <li>
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </li>
            </a>
        </div>
    </ul>
</section>

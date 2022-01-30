<section class="sidenav full_vh br_1 overflow_y noscroll">
    <ul class="selectable card card_noformat empty">

        {{-- header  --}}
        <div>
            <a href="/users" title="User">
                <li class="@yield('users')">
                    <i class="fas fa-smile"></i>
                    <span>John@admin</span>
                </li>
            </a>
            <hr class="my_10">
        </div>
    
        {{-- body  --}}
        <div>
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
            <a href="/schedules" title="Schedules">
                <li class="@yield('schedules')">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Schedules</span>
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

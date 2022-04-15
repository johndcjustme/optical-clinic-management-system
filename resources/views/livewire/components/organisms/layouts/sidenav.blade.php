


<section class="section_sidenav full_vh overflow_hidden" style="background-color: rgb(243, 243, 243)">

    <div class="flex flex_column flex_x_between full_h">
        <ul class="selectable p_7 empty overflow_y noscroll">
            <div class="mt_10 mb_10 overflow_hidden" style="">
                <img class="" src="{{ asset('images/dango-logo-nolabel.png') }}" alt="" width="40px" height="auto">
            </div>
            <hr class="my_10" style="border-top: 1px solid rgba(0, 0, 0, 0.090);">
            <div>
                <a href="/dashboard" title="Dashboard">
                    <li class="@yield('dashboard') ">
                        <ion-icon name="pie-chart-outline"></ion-icon>
                        <span>Dashboard</span>
                    </li>
                </a>
                <a href="/patients" title="Patient">
                    <li class="@yield('patients') ">
                        <ion-icon name="people-outline"></ion-icon>
                        <span>Patients</span>
                    </li>
                </a>
                <a href="/inventory" title="Inventory">
                    <li class="@yield('inventory') ">
                        <ion-icon name="albums-outline"></ion-icon>
                        <span>Inventory</span>
                    </li>
                </a>
                <a href="/suppliers" title="Supplier">
                    <li class="@yield('suppliers') ">
                        <ion-icon name="bus-outline"></ion-icon>
                        <span>Suppliers</span>
                    </li>
                </a>
                <a href="/orders" title="Orders">
                    <li class="@yield('orders') ">
                        <ion-icon name="cart-outline"></ion-icon>
                        <span>Orders</span>
                    </li>
                </a>
                <a href="/appointments" title="Appointments">
                    <li class="@yield('appointments') ">
                        <ion-icon name="calendar-outline"></ion-icon>
                        <span>Appointments</span>
                    </li>
                </a>
                <a href="/users" title="User">
                    <li class="@yield('users') ">
                        <ion-icon name="person-outline"></ion-icon>
                        <span>Users</span>
                    </li>
                </a>
                <a href="/patient-appt" title="Book">
                    <li class="@yield('patientAppt') ">
                        <ion-icon name="calendar-outline"></ion-icon>
                        <span>Book</span>
                    </li>
                </a>
                <a href="/reports" title="Report">
                    <li class="@yield('reports') ">
                        <ion-icon name="pulse-outline"></ion-icon>
                        <span>Reports</span>
                    </li>
                </a>
                <a href="/forum" title="Forum">
                    <li class="@yield('forum') ">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                        <span>Furom</span>  
                    </li>
                </a>
            </div>
            <div>
                <hr class="my_10" style="border-top: 1px solid rgba(0, 0, 0, 0.090);">
                <a href="#" title="Logout">
                    <li class="">
                        <ion-icon name="log-out-outline" class="red"></ion-icon>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <span onclick="event.preventDefault(); this.closest('form').submit();">Logout</span>
                        </form>
                    </li>
                </a>
            </div>
        </ul>

        
        <div class="p_7 relative bt_1">
            <div class="sidenav_user_avatar overflow_hidden">
                <div onclick="window.location.assign('/account')" class="pointer">
                    <x-atom.profile-photo size="35px" path="{{ $this->storage(Auth::user()->avatar) }}"/>
                </div>
                <span class="ml_7 x-flex x-flex-column">
                    <div style="font-weight: bold">{{ Auth::user()->name }}</div>
                    <small class="">{{ Auth::user()->email }}</small>
                </span>
            </div>
        </div>
    </div>
</section>

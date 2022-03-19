


<section class="section_sidenav full_vh overflow_hidden" style="background-color: rgb(248, 248, 248)">

    <div class="flex flex_column flex_x_between full_h">
        <ul class="selectable p_7 empty overflow_y noscroll">
            <div class="mt_10 mb_10 overflow_hidden" style="">
                <img class="" src="{{ asset('images/dango-logo-nolabel.png') }}" alt="" width="40px" height="auto">
                {{-- <div class="flex flex_center text_left mt_7">
                    <div class="flex flex_center">
                    </div>
                    <span class="mt_6 flex flex_y_center text_left" style="line-height: 1rem; width:auto;">
                        <b style="font-size: 1.3rem;">DANGO</b>                        
                        <span style="font-size: 0.6rem;">OPTICAL CLINIC</span>
                    </span>
                </div> --}}
            </div>
            <hr class="my_10" style="border-top: 1px solid rgba(0, 0, 0, 0.090);">
            <div>
                {{-- <span class="light_500 font_bold" style="font-size: 0.7rem">NAVIGATION</span> --}}
                {{-- <hr class="mb_10"> --}}
                <a href="/dashboard" title="Dashboard">
                    <li class="@yield('dashboard') ">
                        <ion-icon name="pie-chart-outline"></ion-icon>
                        {{-- <i class="fas fa-chart-area"></i> --}}
                        <span>Dashboard</span>
                    </li>
                </a>
                <a href="/patients" title="Patient">
                    <li class="@yield('patients') ">
                        <ion-icon name="people-outline"></ion-icon>
                        {{-- <i class="fas fa-user-friends"></i> --}}
                        <span>Patients</span>
                    </li>
                </a>
                <a href="/inventory/1" title="Inventory">
                    <li class="@yield('inventory') ">
                        <ion-icon name="albums-outline"></ion-icon>
                        {{-- <i class="fas fa-boxes"></i> --}}
                        <span>Inventory</span>
                    </li>
                </a>
                <a href="/orders" title="Orders">
                    <li class="@yield('orders') ">
                        <ion-icon name="cart-outline"></ion-icon>
                        {{-- <i class="fas fa-shopping-cart"></i> --}}
                        <span>Orders</span>
                    </li>
                </a>
                <a href="/appointments" title="Appointments">
                    <li class="@yield('appointments') ">
                        <ion-icon name="calendar-outline"></ion-icon>
                        {{-- <i class="fas fa-calendar-check"></i> --}}
                        <span>Appointments</span>
                    </li>
                </a>
                <a href="/users" title="User">
                    <li class="@yield('users') ">
                        <ion-icon name="person-outline"></ion-icon>
                        {{-- <i class="fas fa-smile"></i> --}}
                        <span>Users</span>
                    </li>
                </a>
                <a href="/patient-appt" title="Book">
                    <li class="@yield('patientAppt') ">
                        <ion-icon name="calendar-outline"></ion-icon>
                        {{-- <i class="fas fa-smile"></i> --}}
                        <span>Book</span>
                    </li>
                </a>
                <a href="/forum" title="Forum">
                    <li class="@yield('furom') ">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                        {{-- <i class="fas fa-smile"></i> --}}
                        <span>Furom</span>
                    </li>
                </a>
            </div>
            <div>
                {{-- <hr class="my_10"> --}}
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
                    <x-atom.profile-photo size="35px" path="storage/photos/avatars/{{ Auth::user()->avatar }}"/>
                </div>
                <span class="ml_7">
                    <div class="mb_2" style="font-size: 0.7rem; font-weight: bold">{{ Auth::user()->name }}</div>
                    <div class="" style="font-size: 0.55rem">{{ Auth::user()->email }}</div>
                </span>
            </div>
        </div>
    </div>
</section>

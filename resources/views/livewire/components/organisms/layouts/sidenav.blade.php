


<section class="section_sidenav full_vh overflow_hidden" style="background: rgba(243, 243, 243);">

    <div class="flex flex_column flex_x_between full_h">
        <ul class="selectable p_7 empty overflow_y noscroll">
            <div class="mt_10 mb_10 overflow_hidden" style="">
                <img class="" src="{{ asset('images/dango-logo-nolabel3.png') }}" alt="" width="40px" height="auto">
            </div>
            {{-- <hr class="my_10" style="border-top: 1px solid rgba(0, 0, 0, 0.090);"> --}}
            <div class="ui divider"></div>
            <div>
                @if (Auth::user()->hasRole('admin'))
                    <a href="/dashboard" title="Dashboard">
                        <li class="@yield('dashboard') ">
                            {{-- <ion-icon name="pie-chart-outline"></ion-icon> --}}
                            <i class="icon chart bar"></i>
                            <span>Dashboard</span>
                        </li>
                    </a>
                    <a href="/patients" title="Patient">
                        <li class="@yield('patients') ">
                            {{-- <ion-icon name="people-outline"></ion-icon> --}}
                            <i class="icon wheelchair"></i>
                            <span>Patients</span>
                        </li>
                    </a>
                    <a href="/inventory" title="Inventory">
                        <li class="@yield('inventory') ">
                            {{-- <ion-icon name="albums-outline"></ion-icon> --}}
                            <i class="icon boxes"></i>
                            <span>Inventory</span>
                        </li>
                    </a>
                    <a href="/suppliers" title="Supplier">
                        <li class="@yield('suppliers') ">
                            {{-- <ion-icon name="layers-outline"></ion-icon> --}}
                            <i class="icon square outline"></i>
                            <span>Suppliers</span>
                        </li>
                    </a>
                    <a href="/orders" title="Orders">
                        <li class="@yield('orders') ">
                            {{-- <ion-icon path="sidebar-icons/cart-outline.svg"></ion-icon> --}}
                            <i class="icon cart arrow down"></i>
                            <span>Orders</span>
                        </li>
                    </a>
                    <a href="/appointments" title="Appointments">
                        <li class="@yield('appointments') ">
                            {{-- <ion-icon name="calendar-outline"></ion-icon> --}}
                            <i class="icon calendar alternate outline"></i>
                            <span>Appointments</span>
                        </li>
                    </a>
                    <a href="/users" title="User">
                        <li class="@yield('users') ">
                            {{-- <ion-icon name="person-outline"></ion-icon> --}}
                            <i class="icon user outline"></i>
                            <span>Users</span>
                        </li>
                    </a>

                    <a href="/reports" title="Report">
                        <li class="@yield('reports') ">
                            {{-- <ion-icon name="pulse-outline"></ion-icon> --}}
                            <i class="icon chart line"></i>
                            <span>Reports</span>
                        </li>
                    </a>
                @endif

                @if (Auth::user()->hasRole('user')) 
                    <a href="/book" title="Book">
                        <li class="@yield('patientAppt') ">
                            {{-- <ion-icon name="calendar-outline"></ion-icon> --}}
                            <i class="icon calendar outline"></i>
                            <span>Book</span>
                        </li>
                    </a>
                @endif
                @if (Auth::user()->hasROle('admin|staff|user'))
                    <a href="/forum" title="Forum">
                        <li class="@yield('forum') ">
                            {{-- <ion-icon name="chatbubbles-outline"></ion-icon> --}}
                            <i class="icon comments outline"></i>
                            <span>Furom</span>  
                        </li>
                    </a>
                @endif

            </div>
            <div>
                <div class="ui divider"></div>
                {{-- <hr class="my_10" style="border-top: 1px solid rgba(0, 0, 0, 0.090);"> --}}
                <a href="#" title="Logout">
                    <li class="">
                        {{-- <ion-icon name="power-outline" style="color: red"></ion-icon> --}}
                        <i class="icon power" style="color: red"></i>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <span onclick="event.preventDefault(); this.closest('form').submit();">Logout</span>
                        </form>
                    </li>
                </a>
            </div>
        </ul>

        <div class="relative bt_1" style="padding:0.7em;">
            <div class="sidenav_user_avatar overflow_hidden">
                <div>
                    <a href="/account" class="pointer">
                        <x-atom.profile-photo size="2.5em" path="{{ $this->storage(Auth::user()->avatar) }}"/>
                    </a>
                </div>
                <span class="ml_7 x-flex x-flex-column">
                    <div style="font-weight:bold; font-size;0.2rem">{{ Auth::user()->name }}</div>
                    <small class="" style="opacity:0.6">{{ Auth::user()->email }}</small>
                </span>
            </div>
        </div>
    </div>
</section>

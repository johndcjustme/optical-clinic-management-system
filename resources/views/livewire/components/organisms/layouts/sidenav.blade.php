
@php
    $navigations = [
        [
            'icon' => 'fa-chart-area',
            'link' => 'dashboard',
            'title' => 'Dashboard',
        ], 
        [
            'icon' => 'fa-clipboard-list',
            'link' => 'ledger',
            'title' => 'Ledger',
        ], 
    ];

    $patients = [
        [
            'icon' => 'fa-hospital-user',
            'link' => 'patients',
            'title' => 'Patients',
        ],
        [
            'icon' => 'fa-cart-shopping',
            'link' => 'orders',
            'title' => 'Orders',
        ],
        [
            'icon' => 'fa-calendar',
            'link' => 'appointments',
            'title' => 'Appointments',
        ],
    ];

    $inventory = [
        [
            'icon' => 'fa-boxes-stacked',
            'link' => 'inventory',
            'title' => 'Inventory',
        ],
        [
            'icon' => 'fa-cart-flatbed',
            'link' => 'suppliers',
            'title' => 'Suppliers',
        ],
    ];

    $others = [
        [
            'icon' => 'fa-chart-column',
            'link' => 'reports',
            'title' => 'Reports',
        ],
        [
            'icon' => 'fa-users',
            'link' => 'users',
            'title' => 'Users',
        ],
    ]
@endphp






<div class="h-screen scroll-smooth overflow-y-auto noscroll">


    <div class="my-8" style="">
        <img class="" src="{{ asset('images/dango-logo-nolabel3.png') }}" alt="" width="40px" height="auto">
    </div>





    
    <ul class="menu">

        <li class="menu-title">
            <span class="md:block hidden">Overview</span>
            <span class="md:hidden block text-center"><i class="fa-solid fa-minus"></i></span>
        </li>

        @foreach ($navigations as $nav)
            @include('livewire.components.organisms.layouts.sidenav.link')
        @endforeach

        <li class="menu-title mt-3">
            <span class="md:block hidden">Patients</span>
            <span class="md:hidden block text-center"><i class="fa-solid fa-minus"></i></span>
        </li>
        
        @foreach ($patients as $nav)
            @include('livewire.components.organisms.layouts.sidenav.link')
        @endforeach

        <li class="menu-title mt-3">
            <span class="md:block hidden">Inventory</span>
            <span class="md:hidden block text-center"><i class="fa-solid fa-minus"></i></span>
        </li>
        
        @foreach ($inventory as $nav)
            @include('livewire.components.organisms.layouts.sidenav.link')
        @endforeach

        <li class="menu-title mt-3">
            <span class="md:block hidden">Others</span>
            <span class="md:hidden block text-center"><i class="fa-solid fa-minus"></i></span>
        </li>

        @foreach ($others as $nav)
            @include('livewire.components.organisms.layouts.sidenav.link')
        @endforeach
    </ul>





    {{-- <div class="flex flex_column flex_x_between full_h">
        <ul class="selectable p_7 empty overflow_y noscroll">
            <div class="mt_10 mb_10 overflow_hidden" style="">
                <img class="" src="{{ asset('images/dango-logo-nolabel3.png') }}" alt="" width="40px" height="auto">
            </div>



            <div class="mt-16">
                @if (Auth::user()->hasRole(['admin', 'staff']))
                    <a href="/dashboard" title="Dashboard">
                        <li class="@yield('dashboard')">
                            <i class="fa-solid fa-chart-area"></i>
                            <span>Dashboard</span>
                        </li>
                    </a>
                    <a href="/ledger" title="Ledger">
                        <li class="@yield('ledger') ">
                            <i class="fa-solid fa-clipboard-list"></i>
                            <span>Ledger</span>
                        </li>
                    </a>

                    <div class="divider mt-1 mb-1 opacity-50"></div>

                    <a href="/patients" title="Patient">
                        <li class="@yield('patients')">
                            <i class="fa-solid fa-hospital-user"></i>
                            <span>Patients</span>
                        </li>
                    </a>
                    <a href="/orders" title="Orders">
                        <li class="@yield('orders') ">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span>Orders</span>
                        </li>
                    </a>
                    <a href="/appointments" title="Appointments">
                        <li class="@yield('appointments') ">
                            <i class="fa-solid fa-calendar"></i>
                            <span>Appointments</span>
                        </li>
                    </a>

                    <div class="divider mt-1 mb-1 opacity-50"></div>

                    <a href="/inventory" title="Inventory">
                        <li class="@yield('inventory') ">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            <span>Inventory</span>
                        </li>
                    </a>
                    <a href="/suppliers" title="Supplier">
                        <li class="@yield('suppliers') ">
                            <i class="fa-solid fa-cart-flatbed"></i>
                            <span>Suppliers</span>
                        </li>
                    </a>

                    <div class="divider mt-1 mb-1 opacity-50"></div>
               



                    <a href="/reports" title="Report">
                        <li class="@yield('reports') ">
                            <i class="fa-solid fa-chart-column"></i>
                            <span>Reports</span>
                        </li>
                    </a>
                    <a href="/users" title="User">
                        <li class="@yield('users') ">
                            <i class="fa-solid fa-users"></i>
                            <span>Users</span>
                        </li>
                    </a>
                @endif

                @if (Auth::user()->hasRole('user')) 
                    <a href="/book" title="Book">
                        <li class="@yield('patientAppt') ">
                            <i class="fa-solid fa-calendar"></i>
                            <span>Book</span>
                        </li>
                    </a>
                    <a href="/forum" title="Forum">
                        <li class="@yield('forum') ">
                            <i class="fa-solid fa-comments"></i>
                            <span>Forum</span>  
                        </li>
                    </a>
                @endif
            </div>
        </ul>
    </div>

     --}}
</div>

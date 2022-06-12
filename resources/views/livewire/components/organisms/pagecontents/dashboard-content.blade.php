<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Dashboard"
            desc="Hi {{ Auth::user()->name }}, have a nice day."/>
    @endsection

    @section('section-links')
        <x-atoms.ui.button class="btn-circle"  onclick="window.print()">
            <i class="fa-solid fa-print"></i>
        </x-atoms.ui.button>
    @endsection

    @section('section-heading-left')
    @endsection

    @section('section-main') 



    {{-- @php


        // foreach ($items as $item) {
        //     echo $item->item_name;
        // }

        $max = [];

        foreach (App\Models\Item::with('in_out')->get() as $item) {
            echo $max[] = $item->id . ', ' . $item->in_out->sum('qty') . '<br>';
        }

    @endphp --}}

{{-- 

    @foreach (App\Models\Item::width('in_out') as $item)
        <li>{{ $item->item_id }}</li>
    @endforeach
    

    Product::with('sales')
            ->leftJoin('orders','products.id','=','orders.product_id')
            ->selectRaw('products.*, COALESCE(sum(orders.item_count),0) total')
            ->groupBy('products.id')
            ->orderBy('total','desc')
            ->take(5)
            ->get();
 --}}



        <div id="print-me" style="display:flex; flex-direction:column; width:100%;">
                {{-- <div class="ui grid">
                    <div class="sixteen wide column">
                        <div class="ui secondary menu">
                            <a wire:click.prevent="$set('stat', 'patients')" class="item animate_left {{ $stat == 'patients' ? 'active' : '' }}" style="position:relative;">
                                Patients
                            </a>
                            <a wire:click.prevent="$set('stat', 'orders')" class="item animate_left {{ $stat == 'orders' ? 'active' : '' }}" style="position:relative;">
                                Orders
                            </a>
                            <a wire:click.prevent="$set('stat', 'appointments')" class="item animate_left {{ $stat == 'appointments' ? 'active' : '' }}" style="position:relative;">
                                Appointments
                                @if ($this->appointmentStats('today') > 0)
                                    <small style="position: absolute; top:-3px; right:-3px; height:15px; width:15px; border-radius:50%; background:red; color:white;" class="x-flex x-flex-center">{{ $this->appointmentStats('today') }}</small>
                                @endif
                            </a>
                        </div>

                        @switch($stat)
                            @case('patients')
                                <div class="ui horizontal equal width segments">
                                    <div class="ui centered aligned segment inverted black">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui inverted statistic">
                                                <div class="label">
                                                    Patient's Total
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('all') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    Today
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('today') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    Yesterday
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('yesterday') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    This Week
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('thisWeek') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @break
                        
                            @case('orders')
                                <div class="ui horizontal equal width segments">
                                    <div class="ui centered aligned segment inverted black">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui inverted statistic">
                                                <div class="label">
                                                    Order's Total
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('all') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    To order
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('today') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    pending
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('yesterday') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    Recieved
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('thisWeek') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @break
                                
                            @case('appointments')
                                <div class="ui horizontal equal width segments">
                                    <div class="ui centered aligned inverted black segment" style="potisiton:relative;">
                                        @if ($this->appointmentStats('today') > 0)
                                            <small style="position: absolute; top:1em; right:1em; height:10px; width:10px; border-radius:50%; background:red; color:white;" class="x-flex x-flex-center"></small>
                                        @endif
                                        <div class="x-flex x-flex-center">
                                            <div class="ui inverted statistic">
                                                <div class="label">
                                                    Today
                                                </div>
                                                <div class="value">
                                                    {{ $this->appointmentStats('today') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    Tomorrow
                                                </div>
                                                <div class="value">
                                                    {{ $this->appointmentStats('tomorrow') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    on going
                                                </div>
                                                <div class="value">
                                                    {{ $this->appointmentStats('ongoing') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    For Approval
                                                </div>
                                                <div class="value">
                                                    {{ $this->appointmentStats('forApproval') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @break
                            @default
                        @endswitch
                    </div>
                </div> --}}
                

                

                <div class="ui stackable three column grid">

                    <div class="column">

                        <div class="card card-compact bg-indigo-500 shadow">

                            <div class="card-body">
                                <h1 class="text-2xl font-bold text-primary-content">Patients</h1>
                            </div>

                            <div class="stats stats-vertical lg:stats-horizontal bg-transparent text-primary-content w-full">
                            
                                <div class="stat">
                                    <div class="stat-title">Total</div>
                                    <div class="stat-value">
                                        {{ $this->totalOfPatients('all') }}
                                    </div>
                                    {{-- <div class="stat-desc">View <i class="fa-solid fa-arrow-right"></i></div> --}}
                                </div>
                                
                                <div class="stat">
                                    <div class="stat-title">Today</div>
                                    <div class="stat-value">
                                        {{ $this->totalOfPatients('today') }}
                                    </div>
                                    {{-- <div class="stat-desc">View <i class="fa-solid fa-arrow-right"></i></div> --}}
                                </div>
                                
                                <div class="stat">
                                    <div class="stat-title">Yesterday</div>
                                    <div class="stat-value">
                                        {{ $this->totalOfPatients('yesterday') }}
                                    </div>
                                    {{-- <div class="stat-desc">View <i class="fa-solid fa-arrow-right"></i></div> --}}
                                </div>
                                
                            </div>
                        </div>

                        {{-- <div class="ui segments">
                            <div class="ui segment secondary">
                                <h5>
                                    <i class="icon wheelchair"></i>
                                    PATIENTS
                                </h5>
                            </div>
                            <div class="ui segment">
                                <div class="ui horizontal statistic">
                                    <div class="value">
                                        {{ $this->totalOfPatients('all') }}
                                    </div>
                                    <div class="label">
                                      total
                                    </div>
                                </div>
                                <div class="ui three columns grid" style="margin-top:0.2em">
                                    <div class="column" style="text-align: center">
                                        <h3 class="ui header">
                                            {{ $this->totalOfPatients('today') }}
                                            <div class="sub header">today</div>
                                        </h3>
                                    </div>
                                    <div class="column" style="text-align: center">
                                        <h3 class="ui header">
                                            {{ $this->totalOfPatients('yesterday') }}
                                            <div class="sub header">yesterday</div>
                                        </h3>
                                    </div>
                                    <div class="column" style="text-align: center">
                                        <h3 class="ui header">
                                            {{ $this->totalOfPatients('thisWeek') }}
                                            <div class="sub header">this week</div>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    <div class="column">
                        <div class="card card-compact shadow bg-indigo-500">
                            <div class="card-body">
                                <h1 class="text-2xl font-bold text-primary-content">
                                    Appointment
                                </h1>
                            </div>
                            <div class="stats stats-vertical lg:stats-horizontal bg-transparent text-secondary-content w-full">
                            
                                <div class="stat">
                                    <div class="stat-title">Today</div>
                                    <div class="stat-value">
                                        {{ $this->appointmentStats('today') }}
                                    </div>
                                    {{-- <a href="#" class="stat-desc">View <i class="fa-solid fa-arrow-right"></i></a> --}}
                                </div>
                                
                                <div class="stat">
                                    <div class="stat-title">For approval</div>
                                    <div class="stat-value">
                                        {{ $this->appointmentStats('forApproval') }}
                                    </div>
                                    {{-- <a href="appointments?activeMenu=22" class="stat-desc">View <i class="fa-solid fa-arrow-right"></i></a> --}}
                                </div>
                                
                                <div class="stat">
                                    <div class="stat-title">Approved</div>
                                    <div class="stat-value">
                                        {{ $this->appointmentStats('ongoing') }}
                                    </div>
                                    {{-- <a href="appointments?activeMenu=33" class="stat-desc">View <i class="fa-solid fa-arrow-right"></i></a> --}}
                                </div>
                                
                            </div>

                        </div>


                        {{-- <div class="ui segments">
                            <div class="ui segment secondary">
                                <h5>
                                    <i class="icon cart"></i>
                                    ORDERS
                                </h5>
                            </div>
                            <div class="ui segment">
                                <div class="ui horizontal statistic">
                                    <div class="value">
                                        452
                                    </div>
                                    <div class="label">
                                      total
                                    </div>
                                </div>
                                <div class="ui three columns grid" style="margin-top:0.2em">
                                    <div class="column" style="text-align: center">
                                        <h3 class="ui header">
                                            23
                                            <div class="sub header">today</div>
                                        </h3>
                                    </div>
                                    <div class="column" style="text-align: center">
                                        <h3 class="ui header">
                                            45
                                            <div class="sub header">yesterday</div>
                                        </h3>
                                    </div>
                                    <div class="column" style="text-align: center">
                                        <h3 class="ui header">
                                            32
                                            <div class="sub header">this week</div>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>


                    <div class="column">
           
                        <div class="card card-compact shadow bg-indigo-500">
                            <div class="card-body">
                                <h1 class="text-2xl font-bold text-primary-content">
                                    Orders
                                </h1>
                            </div>
                            <div class="stats stats-vertical lg:stats-horizontal text-primary-content bg-transparent w-full">
                            
                                <div class="stat">
                                    <div class="stat-title">Pending</div>
                                    <div class="stat-value">
                                        {{ $this->orderStats(2) }}
                                    </div>
                                    {{-- <div class="stat-desc">View <i class="fa-solid fa-arrow-right"></i></div> --}}
                                </div>
                                
                                <div class="stat">
                                    <div class="stat-title">Recieved</div>
                                    <div class="stat-value">
                                        {{ $this->orderStats(3) }}
                                    </div>
                                    {{-- <div class="stat-desc">View <i class="fa-solid fa-arrow-right"></i></div> --}}
                                </div>
                                
                                <div class="stat">
                                    <div class="stat-title">Claimed</div>
                                    <div class="stat-value">
                                        {{ $this->orderStats(4) }}
                                    </div>
                                    {{-- <div class="stat-desc">View <i class="fa-solid fa-arrow-right"></i></div> --}}
                                </div>
                                
                            </div>
                        </div>

                        {{-- <div class="ui segments">
                            <div class="ui segment secondary">
                                <h5>
                                    <i class="icon calendar"></i>
                                    APPOINTMENTS
                                </h5>
                            </div>
                            <div class="ui segment">
                                <div class="ui horizontal statistic">
                                    <div class="value">
                                        {{ $this->appointmentStats('today') }}
                                    </div>
                                    <div class="label">
                                      Today
                                    </div>
                                </div>
                                <div class="ui three columns grid" style="margin-top:0.2em">
                                    <div class="column" style="text-align: center">
                                        <h3 class="ui header">
                                            {{ $this->appointmentStats('tomorrow') }}
                                            <div class="sub header">Tomorrow</div>
                                        </h3>
                                    </div>
                                    <div class="column" style="text-align: center">
                                        <h3 class="ui header">
                                            {{ $this->appointmentStats('ongoing') }}
                                            <div class="sub header">Ongoing</div>
                                        </h3>
                                    </div>
                                    <div class="column" style="text-align: center">
                                        <h3 class="ui header">
                                            {{ $this->appointmentStats('forApproval') }}
                                            <div class="sub header">For approval</div>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>


                    

{{-- 
                    <div class="four wide computer eight wide tablet eight wide mobile column">
                        <div class="ui segments">
                            <div class="ui segment secondary">
                                <h5>MORE</h5>
                            </div>
                            <div class="ui segment">
                                <div class="ui horizontal statistic">
                                    <div class="value">
                                      2,204
                                    </div>
                                    <div class="label">
                                      total
                                    </div>
                                </div>
                                <div class="ui three columns grid">
                                    <div class="column" style="text-align: center">
                                        <h3 class="ui header">245
                                            <div class="sub header">today</div>
                                        </h3>
                                    </div>
                                    <div class="column" style="text-align: center">
                                        <h3 class="ui header">245
                                            <div class="sub header">yesterday</div>
                                        </h3>
                                    </div>
                                    <div class="column" style="text-align: center">
                                        <h3 class="ui header">245
                                            <div class="sub header">this week</div>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>

                  
            {{-- <div class="ui grid">
                <div class="four wide computer eight wide tablet column">
                    <div class="ui fluid raised link card">
                        <div class="content">
                            <div class="header">
                                <span class="ui text blue">• Patient's Total</span>
                            </div>
                            <div class="ui horizontal statistic blue">
                                <div class="value">
                                    {{ $this->totalOfPatients('all') }}
                                </div>
                                <div class="label">Patients</div>
                            </div>
                        </div>
                        <div class="ui bottom attached button blue">
                            <i class="add icon"></i>
                            Add Friend
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet column">
                    <div class="ui fluid raised link card">
                        <div class="content">
                            <div class="header">
                                <span class="ui text green">
                                    • Today
                                </span>
                            </div>
                            <div class="ui horizontal statistic">
                                <div class="value">
                                    {{ $this->totalOfPatients('today') }}
                                </div>
                                <div class="label">
                                    Patients
                                </div>
                            </div>
                        </div>  
                        <div class="ui bottom attached button green">
                            View
                            <i class="arrow right icon"></i>
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet column">
                    <div class="ui fluid raised link card">
                        <div class="content">
                            <div class="header">
                                <span class="ui text teal">
                                    • Yesterday
                                </span>
                            </div>
                            <div class="ui horizontal statistic">
                                <div class="value">
                                    {{ $this->totalOfPatients('yesterday') }}
                                </div>
                                <div class="label">
                                    Patients
                                </div>
                            </div>
                        </div>
                        <div class="ui bottom attached button teal">
                            View
                            <i class="arrow right icon"></i>
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet column">
                    <div class="ui fluid raised link card">
                        <div class="content">
                            <div class="header">
                                <span class="ui text orange">• This Week</span>
                            </div>
                            <div class="ui horizontal statistic">
                                <div class="value">
                                    {{ $this->totalOfPatients('thisWeek') }}
                                </div>
                                <div class="label">
                                    Patients
                                </div>
                            </div>
                        </div>
                        <div class="ui bottom attached button orange">
                            View
                            <i class="arrow right icon"></i>
                        </div>
                    </div>
                </div>
            </div> --}}




            <div class="ui grid">
                <div class="ten wide computer ten wide tablet sixteen wide mobile column">
                    <div class="card card-compact shadow">
                        <div class="card-body">

                            <div class="flex justify-between">
                                <h2 class="card-title">Yealy Patients</h2>
                                <div>
                                    <x-organisms.ui.dropdown class="dropdown-end">
                                        <x-organisms.ui.dropdown.dropdown-label>
                                            {{ $year }}
                                            <i class="fa-solid fa-caret-down"></i>
                                        </x-organisms.ui.dropdown.dropdown-label>
                                        <x-organisms.ui.dropdown.dropdown-content class="ml-2">
                                                <li wire:click.prevent="$set('year', 2021)" class="item"><a>2021</a></li>
                                                <li wire:click.prevent="$set('year', 2022)" class="item"><a>2022</a></li>
                                                <li wire:click.prevent="$set('year', 2023)" class="item"><a>2023</a></li>
                                        </x-organisms.ui.dropdown.dropdown-content>
                                    </x-organisms.ui.dropdown.dropdown-content>
                                </div>
                            </div>

                            <div class="content" style="height:300px; overflow:hidden;">
                                <livewire:livewire-area-chart
                                    key="{{ $areaChartModel->reactiveKey() }}"
                                    :area-chart-model="$areaChartModel"/>
                            </div>

                            <div class="card-actions justify-end mt-3">
                                <span class="opacity-50">
                                    {{ $this->yearlyPatients($year) }} patients
                                </span>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="six wide computer six wide tablet sixteen wide mobile column">
                    <div class="card card-compact shadow">
                        <div class="card-body">

                            <div class="flex justify-between">
                                <h2 class="card-title">Monthly Patients</h2>
                                <div>
                                    <x-organisms.ui.dropdown class="dropdown-end">
                                        <x-organisms.ui.dropdown.dropdown-label>
                                            {{ $monthlyPatients }}
                                            <i class="fa-solid fa-caret-down"></i>
                                        </x-organisms.ui.dropdown.dropdown-label>
                                        <x-organisms.ui.dropdown.dropdown-content class="ml-2" style="height: 20em; overflow-y:auto">

                                                @php $count = 1 @endphp

                                                @foreach ($months as $month) 
                                                    <li wire:click.prevent="setMonthlyPatients({{ $count++ }}, '{{ $month }}')" class="item"><a>{{ $month }}</a></li>
                                                    @php $count += 2 @endphp
                                                @endforeach
                                        </x-organisms.ui.dropdown.dropdown-content>
                                    </x-organisms.ui.dropdown.dropdown-content>
                                </div>
                            </div>

                            <div class="content" style="height:300px; overflow:hidden">
                                <livewire:livewire-column-chart 
                                    key="{{ $columnChartModel->reactiveKey() }}"
                                    :column-chart-model="$columnChartModel"/>
                            </div>
                            
                            <div class="card-actions justify-end mt-3">
                                <span class="opacity-50">
                                    {{ $this->yearlyPatients($year) }} patients
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <div class="ui grid">
                <div class="six wide computer six wide tablet sixteen wide mobile column">
                    <div class="card card-compact shadow">
                        <div class="card-body">

                            <div class="flex justify-between">
                                <h2 class="card-title">Inventory</h2>
                                <div></div>
                            </div>
                            
                            <div class="content" style="height:300px; overflow:hidden; text-align:center;">
                                <livewire:livewire-pie-chart
                                    key="{{ $pieChartModel->reactiveKey() }}"
                                    :pie-chart-model="$pieChartModel"
                                />
                            </div>

                        </div>
                    </div>
                </div>

                <div class="ten wide computer ten wide tablet sixteen wide mobile column" style="width:60%;">
                    <div class="card card-compact shadow">
                        <div class="card-body">
{{-- 
                            <div class="ui segment secondary">
                                <div class="x-flex x-flex-xbetween">
                                    <div>
                                        <h5>
                                            SOLD OUT PRODUCTS
                                        </h5>
                                    </div>
                                    <div class="x-flex x-gap-1">
                                        <div>
                                            <div class="ui floating dropdown">
                                                {{ $productYearlyDemand }} <i class="dropdown icon"></i>
                                                <div class="menu">
                                                    <div wire:click.prevent="$set('productYearlyDemand', 2021)" class="item">2021</span></div>
                                                    <div wire:click.prevent="$set('productYearlyDemand', 2022)" class="item">2022</span></div>
                                                    <div wire:click.prevent="$set('productYearlyDemand', 2023)" class="item">2023</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
 --}}

                            <div class="flex justify-between">
                                <h2 class="card-title">Sold out products</h2>
                                <div>
                                    <x-organisms.ui.dropdown class="dropdown-end">
                                        <x-organisms.ui.dropdown.dropdown-label>
                                            {{ $productYearlyDemand }}
                                            <i class="fa-solid fa-caret-down"></i>
                                        </x-organisms.ui.dropdown.dropdown-label>
                                        <x-organisms.ui.dropdown.dropdown-content class="ml-2" style="height: 20em; overflow-y:auto">
                                            <li wire:click.prevent="$set('productYearlyDemand', 2021)" class="item"><a>2021</a></li>
                                            <li wire:click.prevent="$set('productYearlyDemand', 2022)" class="item"><a>2022</a></li>
                                            <li wire:click.prevent="$set('productYearlyDemand', 2023)" class="item"><a>2023</a></li>
                                        </x-organisms.ui.dropdown.dropdown-content>
                                    </x-organisms.ui.dropdown.dropdown-content>
                                </div>
                            </div>



                            <div class="ui segment">
                                <div class="content" style="height:300px; overflow:hidden">
                                    <livewire:livewire-column-chart 
                                        key="{{ $itemsColumnChartModel->reactiveKey() }}"
                                        :column-chart-model="$itemsColumnChartModel"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="ui grid">
                <div class="five wide computer five wide tablet sixteen wide mobile column">
                    <div class="card card-compact shadow">
                        <div class="card-body">

                            <div class="flex justify-between">
                                <h2 class="card-title">High Demand Products (9)</h2>
                                <div></div>
                            </div>

                            <div class="noscroll pb-5" style="height:30em; overflow-y: auto">
                                <x-organisms.ui.table>
                                    <x-slot name="thead">
                                        <x-organisms.ui.table.th label="Product Name"/>
                                        <x-organisms.ui.table.th label="Sold" style="width:8em" />
                                    </x-slot>
                                    <x-slot name="tbody">
                                        @foreach ($outStocks as $stock)
                                            <tr>
                                                <x-organisms.ui.table.td
                                                    text="{{ $stock->item_name }}"
                                                    desc="{{ number_format($stock->item_price) ?? '' }}"
                                                    desc-icon="fa-peso-sign"/>
                                                <x-organisms.ui.table.td
                                                    text="{{ $stock->item_qty }}"
                                                    desc="Reserved: {{ $stock->item_buffer }}"/>
                                            </tr>
                                        @endforeach
                                    </x-slot>
                                </x-organisms.ui.table>
                            </div>

                        </div>
                    </div>
                </div>



                <div class="five wide computer five wide tablet sixteen wide mobile column">
                    <div class="card card-compact shadow">
                        <div class="card-body">
                
                            <div class="flex justify-between">
                                <h2 class="card-title">Low Demand Products (9)</h2>
                                <div></div>
                            </div>
                            
                            <div class="noscroll pb-5" style="height:30em; overflow-y: auto">
                                <x-organisms.ui.table>
                                    <x-slot name="thead">
                                        <x-organisms.ui.table.th label="Product Name"/>
                                        <x-organisms.ui.table.th label="Sold" style="width:8em" />
                                    </x-slot>
                                    <x-slot name="tbody">
                                        @foreach ($outStocks as $stock)
                                            <tr>
                                                <x-organisms.ui.table.td
                                                    text="{{ $stock->item_name }}"
                                                    desc="{{ number_format($stock->item_price) ?? '' }}"
                                                    desc-icon="fa-peso-sign"/>
                                                <x-organisms.ui.table.td
                                                    text="{{ $stock->item_qty }}"
                                                    desc="Reserved: {{ $stock->item_buffer }}"/>
                                            </tr>
                                        @endforeach
                                    </x-slot>
                                </x-organisms.ui.table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="six wide computer six wide tablet sixteen wide mobile column">
                    <div class="card card-compact shadow">
                        <div class="card-body">
                            {{-- <div class="ui segment secondary">
                                <h5 class="ui header red">
                                    OUT OF STOCKS ({{ $countLowStocks }})
                                </h5>
                            </div> --}}

                            <div class="flex justify-between">
                                <h2 class="card-title">Out of stocks ({{ $countLowStocks }})</h2>
                                <div></div>
                            </div>

                            <div class="noscroll pb-5" style="height:30em; overflow-y:auto">
                                <x-organisms.ui.table>
                                    <x-slot name="thead">
                                        <x-organisms.ui.table.th label="Product Name"/>
                                        <x-organisms.ui.table.th label="Sold" style="width:8em" />
                                    </x-slot>
                                    <x-slot name="tbody">
                                        @foreach ($outStocks as $stock)
                                            <tr>
                                                <x-organisms.ui.table.td
                                                    text="{{ $stock->item_name }}"
                                                    desc="{{ number_format($stock->item_price) ?? '' }}"
                                                    desc-icon="fa-peso-sign"/>
                                                <x-organisms.ui.table.td
                                                    text="{{ $stock->item_qty }}"
                                                    desc="Reserved: {{ $stock->item_buffer }}"/>
                                            </tr>
                                        @endforeach
                                    </x-slot>
                                </x-organisms.ui.table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="ui grid">
                <div class="sixteen wide column">
                    <div class="ui segments">
                        <div class="ui segment">
                            <h4>
                                Product Sales
                            </h4>
                        </div>
                        <div class="ui segment">
                            <div class="content noscroll" style="height:300px;">
                                <livewire:livewire-column-chart :column-chart-model="$itemsColumnChartModel"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}


         
                
     
    
            {{-- <h3 class="ui dividing header">Top Selling Products</h3>\ --}}
            {{-- <div class="ui grid">
                <div class="sexteen wide column">

                    <div class="ui secondary  menu">
                        <a wire:click.prevent="$set('product', 'top')" class="item {{ $product == 'top' ? 'active' : '' }}" style="position:relative;">
                            Top Products
                        </a>
                        <a wire:click.prevent="$set('product', 'low')" class="item {{ $product == 'low' ? 'active' : '' }}" style="position:relative;">
                            Low In demand
                        </a>
                        <a wire:click.prevent="$set('product', 'out_of_stocks')" class="item {{ $product == 'out_of_stocks' ? 'active' : '' }}" style="position:relative;">
                            Out of Stocks
                            <small style="position: absolute; top:-3px; right:-3px; height:15px; width:15px; border-radius:50%; background:red; color:white;" class="x-flex x-flex-center">7</small>
                        </a>
                    </div>

                    <x-organisms.ui.table class="unstackable compact">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th label="Name" order-by="item_name" />
                            <x-organisms.ui.table.th label="Category" order-by="item_type" />
                            <x-organisms.ui.table.th label="Price" order-by="item_type" />
                            <x-organisms.ui.table.th label="Sold" order-by="item_type" />
                        </x-slot>
                        <x-slot name="tbody">
                            @foreach ($items as $item)
                                <tr>
                                    <x-organisms.ui.table.td
                                        text="{{ $item->item_name }}"
                                        desc="{{ $item->item_desc }}"/>
                                    <x-organisms.ui.table.td
                                        text="{{ $item->category->name ?? '' }}"/>
                                    <x-organisms.ui.table.td
                                        text="{{ number_format($item->item_price) ?? '' }}"
                                        text-icon="fa-peso-sign"/>
                                    <x-organisms.ui.table.td
                                        text="100pcs"
                                        desc="over this year"/>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-organisms.ui.table>
                    {{ $items->links('livewire.components.paginator') }}
                </div>
            </div> --}}
        </div>
    @endsection
</x-layout.page-content>
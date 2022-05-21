<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Dashboard"
            desc="Hi {{ Auth::user()->name }}, have a nice day."/>
    @endsection

    @section('section-links')
        <button class="ui button secondary tiny circular icon"  onclick="window.print()">
            <i class="icon print"></i>
        </button>
    @endsection

    @section('section-heading-left')
    @endsection

    @section('section-main') 



    @php


        // foreach ($items as $item) {
        //     echo $item->item_name;
        // }

        $max = [];

        foreach (App\Models\Item::with('in_out')->get() as $item) {
            echo $max[] = $item->id . ', ' . $item->in_out->sum('qty') . '<br>';
        }

    @endphp

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
                

                

                <div class="ui grid">
                    <div class="four wide computer eight wide tablet eight wide mobile column">
                        <div class="ui segments">
                            <div class="ui segment secondary">
                                <h5>PATIENTS</h5>
                            </div>
                            <div class="ui segment">
                                <div class="ui equal two column grid">
                                    <div class="column">
                                        <h2 class="ui header blue" style="text-align:center">
                                            {{ $this->totalOfPatients('all') }}
                                            <div class="sub header">Total</div>
                                        </h2>
                                    </div>
                                    <div class="column">
                                        <h2 class="ui header" style="text-align:center">
                                            {{ $this->totalOfPatients('today') }}
                                            <div class="sub header">Today</div>
                                        </h2>
                                    </div>
                                    <div class="column">
                                        <h2 class="ui header" style="text-align:center">
                                            {{ $this->totalOfPatients('yesterday') }}
                                            <div class="sub header">Yesterday</div>
                                        </h2>
                                    </div>
                                    <div class="column">
                                        <h2 class="ui header" style="text-align:center">
                                            {{ $this->totalOfPatients('thisWeek') }}
                                            <div class="sub header">This week</div>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="four wide computer eight wide tablet eight wide mobile column">
                        <div class="ui segments">
                            <div class="ui segment secondary">
                                <h5>ORDERS</h5>
                            </div>
                            <div class="ui segment">
                                <div class="ui equal two column grid">
                                    <div class="column">
                                        <h2 class="ui header blue" style="text-align:center">
                                            {{ $this->totalOfPatients('all') }}
                                            <div class="sub header">Total</div>
                                        </h2>
                                    </div>
                                    <div class="column">
                                        <h2 class="ui header" style="text-align:center">
                                            {{ $this->totalOfPatients('all') }}
                                            <div class="sub header">To order</div>
                                        </h2>
                                    </div>
                                    <div class="column">
                                        <h2 class="ui header" style="text-align:center">
                                            {{ $this->totalOfPatients('all') }}
                                            <div class="sub header">Pending</div>
                                        </h2>
                                    </div>
                                    <div class="column">
                                        <h2 class="ui header" style="text-align:center">
                                            {{ $this->totalOfPatients('all') }}
                                            <div class="sub header">Recived</div>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="four wide computer eight wide tablet eight wide mobile column">
                        <div class="ui segments">
                            <div class="ui segment secondary">
                                <h5>APPOINTMENTS</h5>
                            </div>
                            <div class="ui segment">
                                <div class="ui equal two column grid">
                                    <div class="column">
                                        <h2 class="ui header blue" style="text-align:center">
                                            {{ $this->appointmentStats('today') }}
                                            <div class="sub header">today</div>
                                        </h2>
                                    </div>
                                    <div class="column">
                                        <h2 class="ui header" style="text-align:center">
                                            {{ $this->appointmentStats('tomorrow') }}
                                            <div class="sub header">Tomorrow</div>
                                        </h2>
                                    </div>
                                    <div class="column">
                                        <h2 class="ui header" style="text-align:center">
                                            {{ $this->appointmentStats('ongoing') }}
                                            <div class="sub header">Ongoing</div>
                                        </h2>
                                    </div>
                                    <div class="column">
                                        <h2 class="ui header" style="text-align:center">
                                            {{ $this->appointmentStats('forApproval') }}
                                            <div class="sub header">For Approval</div>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="four wide computer eight wide tablet eight wide mobile column">
                        <div class="ui segments">
                            <div class="ui segment secondary">
                                <h5>MORE</h5>
                            </div>
                            <div class="ui segment">
                               some content
                            </div>
                        </div>
                    </div>
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
                    <div class="ui segments">
                        <div class="ui segment secondary">
                            <div class="x-flex x-flex-xbetween  x-flex-ycenter">
                                <div class="x-flex x-flex-ycenter x-gap-1">
                                    <h5 style="padding: 0; margin:0;">
                                        YEARLY PATIENTS
                                    </h5>
                                </div>
                                <div>
                                </div>
                                <div class="x-flex x-gap-1">
                                    <div class="ui floating dropdown">
                                        {{ $year }} <i class="dropdown icon"></i>
                                        <div class="menu">
                                            <div wire:click.prevent="$set('year', 2021)" class="item">2021</span></div>
                                            <div wire:click.prevent="$set('year', 2022)" class="item">2022</span></div>
                                            <div wire:click.prevent="$set('year', 2023)" class="item">2023</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ui segment">
                            <div class="content" style="height:300px; overflow:hidden;">
                                <livewire:livewire-area-chart
                                    key="{{ $areaChartModel->reactiveKey() }}"
                                    :area-chart-model="$areaChartModel"/>
                            </div>
                        </div>
                        <div class="ui segment">
                            <div class="x-flex x-flex-xend">
                                <span class="ui text grey">
                                    {{ $this->yearlyPatients($year) }} patients
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="six wide computer six wide tablet sixteen wide mobile column">
                    <div class="ui segments">
                        <div class="ui segment secondary">
                            <div class="x-flex x-flex-xbetween  x-flex-ycenter">
                                <div class="x-flex x-flex-ycenter x-gap-1">
                                    <h5 style="padding: 0; margin:0;">
                                        MONTHLY PATIENTS
                                    </h5>
                                </div>
                                <div class="x-flex x-gap-1">
                                    <div class="ui floating right pointing dropdown">
                                        {{ $monthlyPatients }} <i class="dropdown icon"></i>
                                        <div class="menu">

                                            @php $count = 1 @endphp

                                            @foreach ($months as $month) 
                                                <div wire:click.prevent="setMonthlyPatients({{ $count++ }}, '{{ $month }}')" class="item">{{ $month }}</span></div>
                                                @php $count += 2 @endphp
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ui segment">
                            <div class="content" style="height:300px; overflow:hidden">
                                <livewire:livewire-column-chart 
                                    key="{{ $columnChartModel->reactiveKey() }}"
                                    :column-chart-model="$columnChartModel"/>
                            </div>
                        </div>
                        <div class="ui segment">
                            <div class="x-flex x-flex-xend">
                                <span class="ui text grey">
                                    {{ $this->yearlyPatients($year) }} patients
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="ui grid">
                <div class="six wide computer six wide tablet sixteen wide mobile column">
                    <div class="ui segments">
                        <div class="ui segment secondary">
                            <h5>INVENTORY</h5>
                        </div>
                        <div class="ui segment">
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
                    <div class="ui segments">
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



            <div class="ui three equal columns grid">
                <div class="five wide computer five wide tablet sixteen wide mobile column">
                    <div class="ui segments">
                        <div class="ui segment secondary">
                            <h5 class="ui header green">
                                HIGH DEMAND PRODUCTS (9)
                            </h5>
                        </div>
                        <div class="ui segment">
                            <div class="content noscroll" style="height:300px; overflow-y: auto">
                                <x-organisms.ui.table class="unstackable compact very basic">
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
                    <div class="ui segments">
                        <div class="ui segment secondary">
                            <h5 class="ui header orange">
                                LOW DEMAND PRODUCTS (7)
                            </h5>
                        </div>
                        <div class="ui segment">
                            <div class="content noscroll" style="height:300px; overflow-y: auto">
                                <x-organisms.ui.table class="unstackable compact very basic">
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
                    <div class="ui segments">
                        <div class="ui segment secondary">
                            <h5 class="ui header red">
                                OUT OF STOCKS ({{ $countLowStocks }})
                            </h5>
                        </div>
                        <div class="ui segment">
                            <div class="content noscroll" style="height:300px; overflow-y: auto">
                                <x-organisms.ui.table class="unstackable compact very basic">
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
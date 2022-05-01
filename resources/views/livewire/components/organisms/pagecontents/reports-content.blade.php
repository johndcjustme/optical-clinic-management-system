<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Reports"
            desc="Lorem ipsum dolor sit amet"/>
    @endsection


    @section('section-links')
        <div class="ui compact tiny menu" style="z-index:300;">
            <div class="ui floating labeled icon dropdown item">
                <i class="icon file alternate" style="margin-right:0.8em;"></i>
                <span class="text">
                    {{ $this->reportCategory($subPage) }}
                </span>
                <div class="menu">
                    <div wire:click.prevent="subPage(1)" class="item">{{ $this->reportCategory(1) }}</div>
                    <div wire:click.prevent="subPage(2)" class="item">{{ $this->reportCategory(2) }}</div>
                    <div wire:click.prevent="subPage(3)" class="item">{{ $this->reportCategory(3) }}</div>
                </div>
            </div>
        </div>
    @endsection

    @section('section-heading-left')
        <button class="ui button tiny circular secondary icon"  onclick="window.print()">
            <i class="icon print"></i>
        </button>
    @endsection


    @section('section-heading-right')

        @if ($filter == 'DATE_RANGE')
            <div class="x-flex x-gap-1 x-flex-ycenter">
                <div class="ui right tiny labeled input @if(!empty($date_to) && empty($date_from)) error @endif">
                    <div class="ui dropdown label">
                        <div class="text">From</div>
                    </div>
                    <input wire:model="date_from" type="date">
                </div>

                <div class="ui right tiny labeled input @if (($date_to < $date_from)) error @endif">
                    <div class="ui dropdown label">
                        <div class="text">To</div>
                    </div>
                    <input wire:model="date_to" type="date">
                </div>
            </div>
        @elseif ($filter == 'SINGLE_DATE')
            <div class="ui right tiny input">
                <input wire:model="date" type="date">
            </div>
        @endif
      


        <x-atoms.ui.header-dropdown-menu class="right pointing tiny">
            <x-slot name="menu"> 
                <div class="header">
                    <i class="icon filter"></i>
                    Filter By
                </div>
                <div wire:click.prevent="$set('filter', 'ALL')" class="item">
                    All
                </div>
                <div wire:click.prevent="$set('filter', 'DATE_RANGE')" class="item">
                    Date Range
                </div>
                <div wire:click.prevent="$set('filter', 'SINGLE_DATE')" class="item">
                    Single Date
                </div>
            </x-slot>
        </x-atoms.ui.header-dropdown-menu>
     
    @endsection

    @section('section-main')
    {{-- <hr> --}}
    <br>
    <div id="print-me" style="width:100%">

        <center>
            <h1 class="ui header">
                {{ $this->reportCategory($subPage) }}
                <p style="opacity:0.6">

                    @switch($filter)
                        @case('DATE_RANGE')
                            From <span style="border-bottom:1px solid gray">{{ humanReadableDate($date_from) }}</span> to <span style="border-bottom:1px solid gray">{{ humanReadableDate($date_to) }}</span>
                            @break
                        @case('SINGLE_DATE')
                            In {{ humanReadableDate($date) }}
                            @break
                        @case('ALL')
                            All Records
                            @break
                        @default
                            <i>Date(s) will appear here</i>
                    @endswitch
                    {{-- @if (!empty($date_from) && !empty($date_to))
                        From <span style="border-bottom:1px solid gray">{{ humanReadableDate($date_from) }}</span> to <span style="border-bottom:1px solid gray">{{ humanReadableDate($date_to) }}</span>
                    @elseif (!empty($date))
                        In {{ humanReadableDate($date) }}
                    @else
                        <i>Date(s) will appear here</i>
                    @endif --}}
                    
                </p>
            </h1>
        </center>
        <br><br>
        @switch($subPage)
            @case(1)
                <center class="text-align:center;">
                    <div class="ui tiny horizontal divided list">
                        <div class="item">
                            Found {{ count($patients) }} Records
                        </div>
                        <div class="item">
                            Order By:
                            <div class="ui floating icon dropdown">
                                <i class="dropdown icon"></i>
                                <span class="text">{{ $this->patientOrderBy($order) }}</span>
                                <div class="menu">  
                                    <div wire:click.prevent="$set('order', 'patient_lname')" class="item">
                                        Name
                                    </div>
                                    <div wire:click.prevent="$set('order', 'created_at')" class="item">
                                        Date Added
                                    </div>
                                    <div wire:click.prevent="$set('order', 'patient_age')" class="item">
                                        Age
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>

                {{-- @if (count($patients) > 0) --}}
                    <x-organisms.ui.table class="fluid">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th label="#" style="width:1em;"/>
                            <x-organisms.ui.table.th>
                                Name <i style="opacity: 0.5">(Last name, First name MI)</i>
                            </x-organisms.ui.table.th>
                            <x-organisms.ui.table.th label="Age"/>
                            <x-organisms.ui.table.th label="Contact Details" style="width:15em;"/>
                            <x-organisms.ui.table.th label="Date Added" style="width:15em;"/>
                        </x-slot>
                        <x-slot name="tbody">
                            @foreach ($patients as $pt)
                                <tr>
                                    <x-organisms.ui.table.td
                                        text="{{ $i++ . '.' }}"/>
                                    <x-organisms.ui.table.td 
                                        text="{{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mname }}"
                                        desc="{{ $pt->patient_address }}"/>
                                    <x-organisms.ui.table.td 
                                        text="{{ $pt->patient_age }}"/>
                                    <x-organisms.ui.table.td 
                                        text="{{ $pt->patient_mobile }}"
                                        desc="{{ $pt->patient_email }}"/>
                                    <x-organisms.ui.table.td 
                                        text="{{ humanReadableDate($pt->created_at) }}"/>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-organisms.ui.table>
                {{-- @else
                    <x-atoms.ui.message 
                        icon="frown open"
                        class="mt_20 warning"
                        header="Found Noting."
                        message="Please double check the selected date."/>
                @endif --}}

                    @break
                    

            @case(2)
                <center>
                    <div class="ui tiny horizontal list">
                        <div class="item">
                            Found {{ count($items) }} Records
                        </div>
                    </div>
                </center>
                <x-organisms.ui.table class="fluid">
                    <x-slot name="thead">
                        <x-organisms.ui.table.th label="#" style="width:1em;"/>
                        <x-organisms.ui.table.th label="Name"/>
                        <x-organisms.ui.table.th label="Date Added" style="width:15em;"/>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($items as $item)
                            <tr>
                                <x-organisms.ui.table.td 
                                    text="{{ $i++.'.' }}"/>
                                <x-organisms.ui.table.td 
                                    text="{{ $item->item_name }}"
                                    desc="{{ $item->item_desc }}"/>
                                <x-organisms.ui.table.td 
                                    text="{{ humanReadableDate($item->created_at) }}"/>
                            </tr>
                        @endforeach
                    
                    </x-slot>
                </x-organisms.ui.table>
                @break
        
            @case(3)
                
                @break
            @default
                
        @endswitch
        







    </div>
    @endsection

</x-layout.page-content>




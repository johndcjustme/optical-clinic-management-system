<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Report"
            desc="Lorem ipsum dolor sit amet"/>
    @endsection


    @section('section-links')
        {{-- <div class="ui compact tiny menu" style="z-index:300;">
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
        </div> --}}
    @endsection

    @section('section-heading-left')
        <button class="btn btn-circle"  onclick="window.print()">
            <i class="fa-solid fa-print"></i>
        </button>
    @endsection


    @section('section-heading-right')

        @if ($filter == 'DATE_RANGE')
            <div class="x-flex x-gap-1 x-flex-ycenter">

                {{-- <div class="form-control"> --}}
                <label class="input-group">
                    <span>From</span>
                    <input wire:model="date_from" type="date" placeholder="info@site.com" class="input input-bordered {{ !empty($date_to) && empty($date_from) ? 'input-error' : ''}}" />
                </label>

                <label class="input-group">
                    <span>To</span>
                    <input wire:model="date_to" type="date" placeholder="info@site.com" class="input input-bordered {{ $date_to < $date_from ? 'input-error' : ''}}" />
                </label>
                {{-- </div> --}}

                {{-- <div class="ui right tiny labeled input @if(!empty($date_to) && empty($date_from)) error @endif">
                    <div class="ui dropdown label">
                        <div class="text">From</div>
                    </div>
                    <input wire:model="date_from" type="date">
                </div> --}}

                {{-- // <div class="ui right tiny labeled input @if (($date_to < $date_from)) error @endif">
                //     <div class="ui dropdown label">
                //         <div class="text">To</div>
                //     </div>
                //     <input wire:model="date_to" type="date">
                // </div> --}}
            </div>
        @elseif ($filter == 'SINGLE_DATE')

            <label class="input-group">
                <span><i class="fa-solid fa-calendar"></i></span>
                <input wire:model="date" type="date" placeholder="info@site.com" class="input input-bordered" />
            </label>
        @endif
      


        <x-organisms.ui.dropdown-end class="fa-filter">
            <li class="menu-title">
                <span>Filter</span>
            </li>
            <li wire:click.prevent="$set('filter', 'ALL')" class="item">
                <a>
                    All
                </a>
            </li>
            <li wire:click.prevent="$set('filter', 'DATE_RANGE')" class="item">
                <a>
                    Date Range
                </a>
            </li>
            <li wire:click.prevent="$set('filter', 'SINGLE_DATE')" class="item">
                <a>
                    Single Date
                </a>
            </li>
        </x-organisms.ui.dropdown-end>
     
    @endsection

    @section('section-main')
    <div id="print-me" class="mt-10" style="width:100%">

        <center class="mb-10">
            <h1 class="text-lg mb-2 font-bold" style="font-size:1.5em;">
                {{ $this->reportCategory($subPage) }}
            </h1>
            <p class="text-lg">
                @switch($filter)
                    @case('DATE_RANGE')
                        <span class="opacity-50 font-b">From</span>
                        {{ humanReadableDate($date_from) }}
                        <span class="opacity-50 font-b">To</span>
                        {{ humanReadableDate($date_to) }}
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
            </p>
        </center>
        
        @switch($subPage)
            @case(1)
                <center class="mb-7">

                    <div class="flex justify-center mb-2">
                        <div class="font-bold">
                            Found {{ count($patients) }} Records
                        </div>
                    </div>

                    <x-organisms.ui.dropdown class="dropdown-end">
                        <x-organisms.ui.dropdown.dropdown-label>
                            <span class="mr-2">
                                Order By: 
                            </span>
                            {{ $this->patientOrderBy($order) }}
                            <i class="ml-1 fa-solid fa-caret-down"></i>
                        </x-organisms.ui.dropdown.dropdown-label>
                        <x-organisms.ui.dropdown.dropdown-content class="ml-2">
                            <li wire:click.prevent="$set('order', 'patient_lname')" class="item">
                                <a>
                                    Name
                                </a>
                            </li>
                            <li wire:click.prevent="$set('order', 'created_at')" class="item">
                                <a>
                                    Date Added
                                </a>
                            </li>
                            <li wire:click.prevent="$set('order', 'patient_age')" class="item">
                                <a>
                                    Age
                                </a>
                            </li>
                        </x-organisms.ui.dropdown.dropdown-content>
                    </x-organisms.ui.dropdown.dropdown-content>

                </center>

                @if (count($patients) > 0)
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
                @else
                    <x-atoms.ui.message 
                        icon="frown open"
                        class="mt_20 warning"
                        header="Found Noting."
                        message="Please double check the selected date."/>
                @endif

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




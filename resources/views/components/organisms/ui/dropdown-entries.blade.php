<li @click="openEntries = ! openEntries">
    <div class="flex justify-between">
        <div>Show Entries <span class="ml-2 opacity-50">{{ $pagenumber }}</span></div>
        <div><i :class="openEntries ? 'fa-caret-down' : 'fa-caret-right'" class="fa-solid"></i></div>
    </div>
</li>
<ul x-show="openEntries" @click.outside="openEntries = false" x-transition class="menu bg-neutral p-2 rounded-box" style="display:none">
    <li wire:click.prevent="$set('pageNumber', 25)" class="text-white"><a>25</a></li>
    <li wire:click.prevent="$set('pageNumber', 50)" class="text-white"><a>50</a></li>
    <li wire:click.prevent="$set('pageNumber', 75)" class="text-white"><a>75</a></li>
    <li wire:click.prevent="$set('pageNumber', 100)" class="text-white"><a>100</a></li>
</ul>
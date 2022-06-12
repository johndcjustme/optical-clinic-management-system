{{-- <div class="" style="max-width: 300px; width:100%; margin-top:2em;"> --}}
    <div class="w-full">
        <a href="/">
            <x-application-logo class=""/>
        </a>
    </div>

    <div class="mt-5">
        {{ $slot }}
    </div>

    <div class="card-actions justify-center">
        {{ $footer ?? null }}
    </div>
    
{{-- </div> --}}


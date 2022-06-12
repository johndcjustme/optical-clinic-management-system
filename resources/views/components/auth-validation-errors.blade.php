@props(['errors'])

@if ($errors->any())
    <div class="p-3 rounded-xl bg-error" {{ $attributes }}>
        <div class="flex content-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <div class="ml-3">
                <span class="font-bold">
                    {{ __('Whoops! Something went wrong.') }}
                </span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
{{-- 

@if(session('passcode_err'))
    <div class="mb_10">
        <p class="red">
            {{ session('passcode_err') }}
        </p>
    </div>
@endif --}}
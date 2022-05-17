@props(['errors'])

@if ($errors->any())
    <div class="ui error message" {{ $attributes }}>
        <div class="header">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
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

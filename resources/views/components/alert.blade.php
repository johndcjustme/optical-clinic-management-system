@if(session()->has('message'))

    <div class="py_10 alert success bg_accent_1 light_100 flex alert_{{ $type }}">
        <div>
            <i class="fas fa-check"></i>
        </div>
        <div class="full_w">
            <div>
                {{ $message }}
            </div>
        </div>
        <div>
            <i class="fa-solid fa-xmark light_300"></i>
        </div>
    </div>

@endif


@if (!empty($header))
    <div id="{{ $id }}" class="ui negative mini message">
        <i onclick="document.getElementById('{{ $id }}').style.display = 'none'" class="close icon"></i>
        <div class="header">
            {{ $header }}
        </div>
        <p>{{ $message }}</p>
    </div>
@else
    <div id="{{ $id }}" class="ui red mini message">{{ $message }}<i
            onclick="document.getElementById('{{ $id }}').style.display = 'none'" class="close icon"></i></div>
@endif

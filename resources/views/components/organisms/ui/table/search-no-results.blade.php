<tr>
    <td {{ $attributes->merge(['colspan'=>''])}}>
        <div class="text_center">
            <span class="ui error text">
                @if (!empty($message))
                    <i class="frown outline icon"></i>
                    {{ $message }}
                @else
                    <i class="frown outline icon"></i>
                    No results found.
                @endif
            </span>
        </div>                                            
    </td>
</tr>
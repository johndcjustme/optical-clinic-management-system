@include('layouts.head')

<a href="/download-pdf">Generate pdf</a>

<table class="ui tablle celled very basic">
    <tr>
        <th>
            Order Id
        </th>
    </tr>
@foreach ($orders as $order)
    {{-- @foreach (App\Models\Ordered_item::with('item')->where('order_id', $order->id) as $ordered_item) --}}
        <tr>
            <td>
                {{ $order }}
            </td>
        </tr>
    {{-- @endforeach --}}
@endforeach

</table>


@include('layouts.foot')


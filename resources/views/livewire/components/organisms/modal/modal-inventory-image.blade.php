<x-organisms.modal>
    @section('modal_title')
    @endsection
    @section('modal_body')
        <h4>{{ $item['name'] }}</h4>

        <img src="{{ storage('items', $item['image']) }}" width="100%" height="auto" style="border-radius: 0.4em">
        
        <p><span style="opacity: 0.6">Category:</span> <b>{{ $item['cat'] }}</b></p>
    @endsection
</x-organisms.modal>
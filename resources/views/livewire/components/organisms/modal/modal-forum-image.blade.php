<x-organisms.modal max-width="800px">
    @section('modal_title')
    @endsection
    @section('modal_body')
        <img src="{{ $displayPhoto }}" width="100%" height="auto" style="border-radius: 0.4em">
    @endsection
</x-organisms.modal>
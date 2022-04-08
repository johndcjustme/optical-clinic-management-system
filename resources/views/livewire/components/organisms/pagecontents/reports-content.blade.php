<x-layout.page-content>

    @section('section-page-title')
        <div class="">
            <div>
                <x-atoms.ui.header title="Reports"/>
            </div>
            <div>
                <small>{{ $this->patientTotal() }} Patients</small>
            </div>
        </div>
    @endsection


    @section('section-links')
    @endsection

    @section('section-heading-left')
    @endsection


    @section('section-heading-right')
    @endsection

    @section('section-main')
        main content
    @endsection

</x-layout.page-content>
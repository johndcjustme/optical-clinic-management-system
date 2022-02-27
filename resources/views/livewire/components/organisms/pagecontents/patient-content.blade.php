<x-layout.page-content>

    @section('section-page-title', 'Patients')

    @section('section-links')
        <x-atom.tab-links.link tab-title="Patients" wire-click="" sub-page="" />
        <x-atom.tab-links.link tab-title="Queue" wire-click="" sub-page="" />
    @endsection

    @section('section-heading-left')
        heading left content
    @endsection

    @section('section-heading-right')
        heading right content
    @endsection

    @section('section-main')


        <div class="items">
            <x-layout.lists-section>
                <h5 class="dark_200 m_5">Today's patients</h5>
                @for ($i = 1; $i < 4; $i++)
                    <x-layout.lists-section.lists-container>
                        <x-layout.lists-section.lists-list list-for="grid_patient list">

                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_center">
                                    <input type="checkbox" class="pointer">
                                </div>
                            </x-layout.lists-section.list-item>

                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="full_w flex flex_center">
                                    <x-atom.profile-photo size="2.5em" path="images/john-profile2.png" />
                                </div>
                            </x-layout.lists-section.list-item>

                            <x-layout.lists-section.list-item item-name="John Doe John Doe fontBold" item-desc="Tandag City" />

                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <p style="font-size: 0.85rem"><i class="fa-solid fa-phone mr_3"></i> 09484710737</p>
                            </x-layout.lists-section.list-item>

                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_center text_center full_w">
                                    <p class="py_2 px_6 bg_red" style="border-radius: 3em; font-size:0.75rem">Scheduled</p>
                                </div>
                            </x-layout.lists-section.list-item>
                            
                            {{-- <div>
                                <div>
                                    <b>
                                        {{ $lense->lense_name }}
                                    </b>
                                    <p class="dark_200" style="font-size: 0.8rem">
                                        {{ $lense->lense_tint }}
                                    </p>
                                </div>
                            </div> --}}
                            {{-- <div>{{ $lense->lense_desc }}</div> --}}

                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_center full_w gap_1">
                                    <div>
                                        <x-atom.btn-bordered color="green" label="exam" height="2.5em"/>
                                    </div>
                                    <div>
                                        <x-atom.btn-bordered color="#ff0000" label="purchase" height="2.5em"/>
                                    </div>
                                </div>
                            </x-layout.lists-section.list-item>

                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_center">
                                    <x-atom.more id="patient{{ $i }}">
                                        <x-atom.more.option wire-click="" option-name="Edit" />
                                        <x-atom.more.option wire-click="" option-name="Add to Queue" />
                                    </x-atom.more>
                                </div>
                            </x-layout.lists-section.list-item>

                        </x-layout.lists-section.lists-list>
                    </x-layout.lists-section.lists-container>
                @endfor

            </x-layout.lists-section>
        </div>

    @endsection

</x-layout.page-content>

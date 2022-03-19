
<x-layout.page-content>

    @section('section-page-title', 'Hello User')

    @section('section-links')
        {{-- <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla, similique.</p> --}}
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, nisi.</p>
    @endsection

    @section('section-heading-left')

    @endsection

    @section('section-heading-right')

    @endsection
    
    @section('section-main')

    
        <div class="grid grid_col-2 gap_1" style="grid-template-columns: auto 250px">
            <div>
                <div>
                    <div>
                        <h5>
                            Some of your personal infomation
                        </h5>
                        <br>

                        

                        <form action="" class="ui form">
                            <div class="two fields">
                                <div class="field">
                                    <x-atoms.ui.label for="" class="">First name</x-atoms.ui.label>
                                    <x-atoms.ui.input type="text" class="mb_7"/>
                                    <x-atoms.ui.label for="" class="">Last name</x-atoms.ui.label>
                                    <x-atoms.ui.input type="text" class="mb_7"/>
                                    <x-atoms.ui.label for="" class="">M.I</x-atoms.ui.label>
                                    <x-atoms.ui.input type="text" class="mb_7"/>
                                </div>
                                <div class="field">
                                    <x-atoms.ui.label for="" class="">Gender</x-atoms.ui.label>
                                    <x-atoms.ui.select wire-modal="" class="mb_7">
                                        <option value="" selected hidden>Select</option>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </x-atoms.ui.select>
                                    <x-atoms.ui.label for="" class="">Address</x-atoms.ui.label>
                                    <x-atoms.ui.input type="text" class="mb_7"/>
                                    <x-atoms.ui.label for="" class="">Occupation</x-atoms.ui.label>
                                    <x-atoms.ui.input type="text" class="mb_7"/>
                                </div>
                            </div>
                        </form>
{{-- 
                        <x-atoms.ui.input type="number"/>
                        <label for="">Contact No</label>
                        <x-atoms.ui.input type="text"/>
                        <label for="">Occupation</label>
                        <input type="text">
                        <label for="">Gender</label>
                        <select name="" id="">
                            <option value="">--Select--</option>
                            <option value="">Male</option>
                            <option value="">Female</option>
                        </select> --}}
                    </div>
                    <br><br>
                    <div>
                        <h4>Booke here.</h4>
                    </div>
                    <br><br>
                    <div>
                        <h5>Pick a Date</h5>
                        <x-atoms.ui.input type="text" class="mb_7" x-data x-init="new Pikaday({ field: $el})" />
                    </div>
                    <br><br>
                    <div>
                        <h5>Morning</h5><br>
                        <div class="flex flex_wrap gap_1">
                            <div class="b_1 p_7 pointer">
                                07:00
                                <i class="fa-solid fa-circle-check ml_4"></i>
                            </div>
                            <div class="b_1 p_7 pointer">
                                08:00
                                <i class="fa-solid fa-circle-check ml_4"></i>
                            </div>
                            <div class="b_1 p_7 pointer">
                                09:00
                                <i class="fa-solid fa-circle-check ml_4"></i>
                            </div>
                            <div class="b_1 p_7 pointer">
                                10:00
                                <i class="fa-solid fa-circle-check ml_4"></i>
                            </div>
                            <div class="b_1 p_7 pointer">
                                11:00
                                <i class="fa-solid fa-circle-check ml_4"></i>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div>
                        <h5>Afternoon</h5><br>
                        <div class="flex flex_wrap gap_1">
                            <div class="b_1 p_7 pointer">
                                01:00
                                <i class="fa-solid fa-circle-check ml_4"></i>
                            </div>
                            <div class="b_1 p_7 pointer">
                                02:00
                                <i class="fa-solid fa-circle-check ml_4"></i>
                            </div>
                            <div class="b_1 p_7 pointer">
                                03:00
                                <i class="fa-solid fa-circle-check ml_4"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <x-atoms.ui.button class="primary">Book Now</x-atoms.ui.button>
            </div>
            <div class="b_1 radius_1 p_10">
                <h5>Holidays</h5>
                <div>
                    <ul class="">
                        <li>
                            New Year
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection

</x-layout.page-content>
<div class="full_w overflow_auto">
    {{-- The Master doesn't talk, he acts. --}}
    <div class="p_20 overflow_x full_w flex flex_x_center">
        <div class="card" style="width:768px">
            <div class="flex">


                <div class="br_1 pr_10" style="min-width: 200px; max-width: 210px;">
                    <div class="mb_8">
                        <a wire:click="showUpdatePatientModal({{ $this->patient_id }})" class="button_text pointer">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                    </div>
                    <div>
                        <center>
                            <div style="background: gray; width: 5em; height: 5em; border-radius: 50%;"></div>
                        </center>
                        <center class="pt_4">
                            <h5 class="text_center noformat" type="text">
                                {{ $this->patient_lname . ', ' . $this->patient_fname . ' ' . $this->patient_mname }}
                            </h5>
                        </center>
                    </div>

                    <br><br>
                
                    {{-- <h6><i class="fas fa-circle mr_3"></i> PEROSNAL INFO</h6><hr> --}}
                    <div>
                        <p class="mt_8">
                            <b>{{ $this->patient_created }}</b>
                        </p>
                        <label class="color_dark" for="">Date Added</label>

                        <p class="mt_8">
                            <b>{{ $this->patient_age }}</b>
                        </p>
                        <label class="color_dark" for="">Age</label>

                        <p class="mt_8">
                            <b>{{ $this->patient_gender }}</b>
                        </p>
                        <label class="color_dark" for="Gender">Gender</label>

                        <p class="mt_8">
                            <b>{{ $this->patient_occupation }}</b>
                        </p>
                        <label class="color_dark" for="">Occupation</label>

                        <p class="mt_8">
                            <b>{{ $this->patient_address }}</b>
                        </p>
                        <label class="color_dark" for="">Address</label>
                    </div>

                    <br><br>

                    {{-- <h6><i class="fas fa-circle mr_3"></i> CONTACT INFO</h6><hr> --}}
                    <div>
                        <p class="mt_8">
                            <b>{{ $this->patient_email }}</b></p>
                        <label class="color_dark" for="">Email</label>

                        <p class="mt_8">
                            <b>{{ $this->patient_mobile }}</b>
                        </p>
                        <label class="color_dark" for="">Mobile number</label>
                    </div>
                </div>



                <div class="flex flex_column ml_10">
                    <div>
                        <h5>SUBJECTIVE EXAM</h5>
                        {{-- <hr> --}}
                        <div class="overflow_x mt_10">
                            <form action="">
                                <input type="hidden" name="" >
                                <table class="noformat" style="min-width: 400px">
                                    <tr>
                                        <td>
                                            <label for="">SPH</label>
                                            <input class="noformat" type="text" value="OD" disabled>
                                        </td>
                                        <td>
                                            <label for="">SPH</label>
                                            <input class="text_right" type="text">
                                        </td>
                                        <td>
                                            <label for="">CYL</label>
                                            <input class="text_right" type="text">
                                        </td>
                                        <td>
                                            <label for="">AXIS</label>
                                            <input class="text_right" type="text">
                                        </td>
                                        <td>
                                            <label for="">NVA</label>
                                            <input class="text_right" type="text">
                                        </td>
                                        <td>
                                            <label for="">PH</label>
                                            <input class="text_right" type="text">
                                        </td>
                                        <td>
                                            <label for="">CVA</label>
                                            <input class="text_right" type="text">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input class="noformat" type="text" value="OS" disabled>
                                        </td>
                                        <td>
                                            <input class="text_right" type="text">
                                        </td>
                                        <td>
                                            <input class="text_right" type="text">
                                        </td>
                                        <td>
                                            <input class="text_right" type="text">
                                        </td>
                                        <td>
                                            <input class="text_right" type="text">
                                        </td>
                                        <td>
                                            <input class="text_right" type="text">
                                        </td>
                                        <td>
                                            <input class="text_right" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="3">
                                            <label for="">ADD</label>
                                            <input class="" type="text">
                                        </td>
                                        <td colspan="3">
                                            <label for="">P.D.</label>
                                            <input class="" type="text">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <div class="text_right mt_10">
                                <button type="submit">Save exam</button>
                            </div>
                        </div>
                    </div>

                    {{-- <hr class="my_15"> --}}
                    <br><br>

                        <div>
                            <h5>PURCHASE</h5>
                            <div class="mt_15">
                                <div class="flex flex_x_between gap_1 full_w pointer">
                                    <a wire:click.prevent="purchaseViewItem('lens')" class="underlined_item_links @if ($this->purchaseViewItem == 'lens') active @else  @endif full_w text_center p_3">Lens</a>
                                    <a wire:click.prevent="purchaseViewItem('frame')" class="underlined_item_links @if ($this->purchaseViewItem == 'frame') active @else  @endif full_w text_center p_3">Frame</a>
                                    <a wire:click.prevent="purchaseViewItem('accessory')" class="underlined_item_links @if ($this->purchaseViewItem == 'accessory') active @else  @endif full_w text_center p_3">Accessory</a>
                                </div>
                                <br>
                                <div>
                                    <form action="">
                                        @if ($this->purchaseViewItem == 'lens')
                                            @include('livewire.components.molecules.patient-purchase-lens')
                                        @elseif ($this->purchaseViewItem == 'frame')
                                            @include('livewire.components.molecules.patient-purchase-frame')
                                        @elseif ($this->purchaseViewItem == 'accessory')
                                            @include('livewire.components.molecules.patient-purchase-accessory')
                                        @endif
                                    </form>
                                </div>
                                <br>
                                <div>
                                    <div class="b_1 p_5">
                                        <p><a class="button_link" href="#"><i class="fas fa-remove mr_3"></i></a> Item 1</p>
                                        <p><a class="button_link" href="#"><i class="fas fa-remove mr_3"></i></a> Item 1</p>
                                        <p><a class="button_link" href="#"><i class="fas fa-remove mr_3"></i></a> Item 1</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <hr class="my_15"> --}}
                        <br><br><br>


                    <form action="">
                        <div>
                            <div class="grid grid_col_2 gap_1">
                                <div>
                                    <label for="">Deposit</label>
                                    <input type="number">
                                    <label for="">Discount</label>
                                    <input type="number">
                                </div>
                                <div class="text_right">
                                    <label for="">Balance</label>
                                    <input class="noformat text_right" type="text" value="500.00" disabled style="font-size: 1.2rem; padding:0.4rem">
                                    <label for="">Total Amount</label>
                                    <input class="noformat text_right" type="text" value="1200.00" disabled style="font-size: 1.2rem; padding:0.4rem">
                                </div>
                            </div>
                            <br><br>
                            <div class="flex flex_x_end flex_y_center">
                                <a href="" class="button_text mr_15">PROCEED TO ORDER</a>
                                <button>Save payment</button>
                            </div>
                        </div>
                    </form>


                </div>


            </div>
        </div>
    </div>
</div>

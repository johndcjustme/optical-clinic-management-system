<form wire:submit.prevent="updateExam({{ $this->exam['id'] }})" id="saveExam">
    <div style="overflow-y: auto; padding-bottom:1em">
        <table class="full_w noformat" style="min-width: 300px; width:100%;">
            <thead>
                <tr>
                    <td>RX</td>
                    <td>SPH</td>
                    <td>CYL</td>
                    <td>AXIS</td>
                    <td>NVA</td>
                    <td>PH</td>
                    <td>CVA</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>OD</td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OD_SPH" type="text" style="width: 70px;"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OD_CYL" type="text" style="width: 70px"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OD_AXIS" type="text" style="width: 70px"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OD_NVA" type="text" style="width: 70px"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OD_PH" type="text" style="width: 70px"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OD_CVA" type="text" style="width: 70px"/></td>
                </tr>
                <tr>
                    <td>OS</td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OS_SPH" type="text" style="width: 70px; margin-top:3px; margin-bottom:3px"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OS_CYL" type="text" style="width: 70px"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OS_AXIS" type="text" style="width: 70px"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OS_NVA" type="text" style="width: 70px"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OS_PH" type="text" style="width: 70px"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OS_CVA" type="text" style="width: 70px"/>
                    </td>
                </tr>
                <tr class="mt_7">
                    <td></td>
                    <td colspan="3">
                        <label>ADD</label>
                        <x-atoms.ui.input wire-model="exam.exam_ADD" type="text" style="width:100%"/></td>
                    <td colspan="3">
                        <label for="">P.D.</label>
                        <x-atoms.ui.input wire-model="exam.exam_PD" type="text" style="width:100%"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="8">
                        <div class="mt_15">
                            <label>REMARKS</label>

                            {{-- <div class="ui fluid icon input"> --}}
                            <div class="ui input fluid">
                                <textarea wire:model.defer="exam.exam_remarks" placeholder="Enter remarks..." rows="2" style="width: 100%"></textarea>
                            </div>
                                {{-- <x-atoms.ui.input wire-model="exam.exam_remarks" placeholder="Enter remarks..." type="text" style="width: 100%"/>
                                <i class="check icon"></i> --}}
                            {{-- </div> --}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>
<style>
    table.tbl-exam tr, table.tbl-exam td {
        padding: 0.4em;
        margin: 0;
        border-bottom: none;
    }
</style>

<form wire:submit.prevent="updateExam({{ $this->exam['id'] }})" id="saveExam" style="{{ ! Auth::user()->hasRole(['sadmin', 'admin']) ? 'pointer-events: none' : '' }}">
    <div style="overflow-y: auto; padding-bottom:1em">
        <table class="tbl-exam" style="min-width: 300px; width:100%;">
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
                    <td class="font-bold">OD</td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OD_SPH" type="text" class="w-full mb-3"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OD_CYL" type="text" class="w-full mb-3"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OD_AXIS" type="text" class="w-full mb-3"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OD_NVA" type="text" class="w-full mb-3"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OD_PH" type="text" class="w-full mb-3"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OD_CVA" type="text" class="w-full mb-3"/></td>
                </tr>
                <tr>
                    <td class="font-bold">OS</td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OS_SPH" type="text" class=""/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OS_CYL" type="text" class="w-full"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OS_AXIS" type="text" class="w-full"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OS_NVA" type="text" class="w-full"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OS_PH" type="text" class="w-full"/></td>
                    <td>
                        <x-atoms.ui.input wire-model="exam.exam_OS_CVA" type="text" class="w-full"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <x-atoms.ui.label>ADD</x-atoms.ui.lab>
                        <x-atoms.ui.input wire-model="exam.exam_ADD" type="text" class="w-full"/></td>
                    <td colspan="3">
                        <x-atoms.ui.label for="">P.D.</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="exam.exam_PD" type="text" class="w-full"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <x-atoms.ui.label>LENSE</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="exam.exam_lense" type="text" placeholder="Enter lense..." class="w-full"/>
                    </td>
                    <td colspan="3">
                        <x-atoms.ui.label>TINT</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="exam.exam_tint" type="text" placeholder="Enter tint..." class="w-full"/>
                    </td>
                   
                </tr>
                <tr>
                    <td></td>
                    <td colspan="6">
                        <x-atoms.ui.label>FRAME</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="exam.exam_frame" type="text" placeholder="Enter frame..." class="w-full"/>
                    </td>
                    {{-- <td colspan="3">
                        <x-atoms.ui.label>OTHERS</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="exam.exam_others" type="text" placeholder="Please specify..." class="w-full"/>
                    </td> --}}
                </tr>
                <tr>
                    <td></td>
                    <td colspan="8">
                        <x-atoms.ui.label>REMARKS</x-atoms.ui.label>
                        <textarea class="input input-bordered w-full" wire:model.defer="exam.exam_remarks" placeholder="Enter remarks..." rows="2"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>





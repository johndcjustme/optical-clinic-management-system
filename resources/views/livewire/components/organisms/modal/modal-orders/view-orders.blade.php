<div style="padding-bottom:25px;">
    <table class="table1" style="width:100%;">
        <tr>
            <td colspan="5"><b>NAME: </b><span class="" style="font-size:16px;">{{ Str::title($order->patient->patient_lname . ', ' . $order->patient->patient_fname . ' ' . $order->patient->patient_mname) }}</span></td>
            <td colspan="2"><b>AGE: </b>{{ $order->patient->patient_age }}</td>
        </tr>
        <tr>
            <td colspan="7"><b>ADDRESS: </b>{{ $order->patient->patient_address}}</td>
        </tr>
        <tr>
            <th colspan="7" style="padding:12px 0"><center><span class="ui header">REFRACTION</span></center></th>
        </tr>
        <tr>
            <th class="text-center">RX</th>
            <th class="text-center">SPH</th>
            <th class="text-center">CYL</th>
            <th class="text-center">AXIS</th>
            <th class="text-center">NVA</th>
            <th class="text-center">PH</th>
            <th class="text-center">CVA</th>
        </tr>
        <tr>
            <th class="text-center">OD</th>
            <td class="text-center">{{ $order->exam->exam_OD_SPH }}</td>
            <td class="text-center">{{ $order->exam->exam_OD_CYL }}</td>
            <td class="text-center">{{ $order->exam->exam_OD_AXIS }}</td>
            <td class="text-center">{{ $order->exam->exam_OD_NVA }}</td>
            <td class="text-center">{{ $order->exam->exam_OD_PH }}</td>
            <td class="text-center">{{ $order->exam->exam_OD_CVA }}</td>
        </tr>
        <tr>
            <th class="text-center">OS</th>
            <td class="text-center">{{ $order->exam->exam_OS_SPH }}</td>
            <td class="text-center">{{ $order->exam->exam_OS_CYL }}</td>
            <td class="text-center">{{ $order->exam->exam_OS_AXIS }}</td>
            <td class="text-center">{{ $order->exam->exam_OS_NVA }}</td>
            <td class="text-center">{{ $order->exam->exam_OS_PH }}</td>
            <td class="text-center">{{ $order->exam->exam_OS_CVA }}</td>
        </tr>
        <tr>
            <th class="text-center">ADD</th>
            <td colspan="2">{{ $order->exam->exam_ADD }}</td>
            <th class="text-center">P. D.</th>
            <td colspan="3">{{ $order->exam->exam_PD }}</td>
        </tr>
        

        <tr>
            <th class="text-center">LENSE</th>
            <td colspan="6" style="padding-top:12px; padding-bottom:12px;">{{ $order->exam->exam_lense }}</td>
        </tr>
        <tr>
            <th class="text-center">TINT</th>
            <td colspan="6" style="padding-top:12px; padding-bottom:12px;">{{ $order->exam->exam_tint }}</td>
        </tr>
        <tr>
            <th class="text-center">FRAME</th>
            <td colspan="6" style="padding-top:12px; padding-bottom:12px;">{{ $order->exam->exam_frame }}</td>
        </tr>
        {{-- <tr>
            <th class="text-center">OTHERS</th>
            <td colspan="6" style="padding-top:12px; padding-bottom:12px;">{{ $order->others }}</td>
        </tr> --}}
        <tr>
            <th class="text-center">REMARKS</th>
            <td colspan="6" style="padding-top:12px; padding-bottom:12px;">{{ $order->exam->exam_remarks }}</td>
        </tr>
    </table>
</div>
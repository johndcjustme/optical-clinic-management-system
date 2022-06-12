<table style="border: 1px solid black">
    <thead>
        <tr>
            <th>Names</th>
            <th>address</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
            <tr>
                <td>{{ $patient->patient_lname }}</td>
                <td>{{ $patient->patient_address }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
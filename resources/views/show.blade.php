@extends("layout")

@section("content")

    <table>
        <tr>
            <th class="registration_num_heading">#</th>
            <th class="registration_name_heading">Name</th>
            <th class="registration_datetime_heading">Zeitpunkt</th>
        </tr>
        @foreach ($registrations as $registration)
            <tr>
                <td class="registration_num">{{ !isset($i) ? $i = 1 : ++$i }}</td>
                <td class="registration_name">{{ $registration->name }}</td>
                <td class="registration_datetime">{{ $registration->created_at->format("D H:i:s") }}</td>
            </tr>
        @endforeach
    </table>


@stop
@extends("layouts.app")

@section("content")

    <div class="container">
        <h3>{{ ucfirst($workshop) }}</h3>

        <table>
            <tr>
                <th class="registration_num_heading">#</th>
                <th class="registration_name_heading">Name</th>
                <th class="registration_email_heading">E-Mail</th>
                <th class="registration_uni_heading">Uni</th>
                <th class="registration_datetime_heading">Zeitpunkt</th>
            </tr>
            @foreach ($registrations as $registration)
                <tr>
                    <td class="registration_num">{{ !isset($i) ? $i = 1 : ++$i }}</td>
                    <td class="registration_name">{{ $registration->name }}</td>
                    <td class="registration_email">{{ $registration->email }}</td>
                    <td class="registration_uni">{{ $registration->uni }}</td>
                    <td class="registration_datetime">{{ $registration->created_at->format("D H:i:s") }}</td>
                </tr>
            @endforeach
        </table>

        @if ($waitinglist)
        <hr>

        <h4>Warteliste</h4>
        <table>
            <tr>
                <th class="registration_num_heading">#</th>
                <th class="registration_name_heading">Name</th>
                <th class="registration_email_heading">E-Mail</th>
                <th class="registration_uni_heading">Uni</th>
                <th class="registration_datetime_heading">Zeitpunkt</th>
            </tr>
            @foreach ($waitinglist as $registration)
                <tr>
                    <td class="registration_num">{{ !isset($j) ? $j = 1 : ++$j }}</td>
                    <td class="registration_name">{{ $registration->name }}</td>
                    <td class="registration_email">{{ $registration->email }}</td>
                    <td class="registration_uni">{{ $registration->uni }}</td>
                    <td class="registration_datetime">{{ $registration->created_at->format("D H:i:s") }}</td>
                </tr>
            @endforeach
        </table>
        @endif

        <hr>

        <div class="bccHeading">Bcc{{ $waitinglist ? " (ohne Warteliste)" : "" }}: </div>
        <div class="bccString">
            {{ $bccString }}
        </div>

    </div>

@stop
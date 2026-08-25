<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">

    <title>Todos Horários Professores</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            font-size:12px;
        }

        h2{
            text-align:center;
            margin-bottom:20px;
            color:#1c359d;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            border:1px solid #000;
            padding:6px;
            text-align:center;
        }

        th{
            background:#f2f2f2;
            font-weight:bold;
        }

        .prof{
            font-weight:bold;
            color:#1c359d;
        }

        .empty{
            color:gray;
            font-style:italic;
        }

        .page-break{
            page-break-after: always;
        }

    </style>

</head>

<body>

<h2>Todos Horários dos Professores</h2>

@foreach($professors as $index => $professor)

    <h3 style="color:#1c359d;">
        {{ $professor->firstname }} {{ $professor->lastname }}
    </h3>

    <table>

        <thead>

            <tr>
                <th>Room</th>
                <th>Course</th>
                <th>Description</th>
                <th>Event Date</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>

        </thead>

        <tbody>

        @php
            $events = $professor->events;
            $hasEvents = false;
        @endphp

        @forelse($events as $event)

            @foreach($event->progevents as $room)

                @php $hasEvents = true; @endphp

                <tr>

                    <td>{{ $room->sala->name ?? '' }}</td>
                    <td>{{ $event->matiere->name ?? '' }}</td>
                    <td>{{ $event->description ?? '' }}</td>
                    <td>{{ $room->data ?? '' }}</td>
                    <td>{{ \Carbon\Carbon::parse($room->inicio)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($room->fim)->format('H:i') }}</td>

                </tr>

            @endforeach

        @empty

            <tr>
                <td colspan="6" class="empty">
                    Nenhum evento agendado
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

    {{-- 👇 PAGE BREAK (menos no último professor) --}}
    @if(!$loop->last)
        <div class="page-break"></div>
    @endif

@endforeach

</body>

</html>
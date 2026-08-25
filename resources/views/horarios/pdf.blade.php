<h2>Professor Schedule</h2>

<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>Professor Name</th>
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
    @endphp

    @if($events->count() > 0)

        @foreach($events as $event)
            @foreach($event->progevents as $room)

                <tr>
                    <td class="prof">
                        {{ $professor->firstname }} {{ $professor->lastname }}
                    </td>

                    <td>{{ $room->sala->name ?? '' }}</td>
                    <td>{{ $event->matiere->name ?? '' }}</td>
                    <td>{{ $event->description }}</td>
                    <td>{{ $room->data }}</td>
                    <td>{{ \Carbon\Carbon::parse($room->inicio)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($room->fim)->format('H:i') }}</td>
                </tr>

            @endforeach
        @endforeach

    @else
        <tr>
            <td class="prof">
                {{ $professor->firstname }} {{ $professor->lastname }}
            </td>
            <td colspan="6">Nenhum evento agendado</td>
        </tr>
    @endif

    </tbody>
</table>
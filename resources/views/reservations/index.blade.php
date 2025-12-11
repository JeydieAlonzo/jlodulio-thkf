
<a href="{{ route('reservations.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create New Reservation</a>

<table class="border-collapse border border-gray-400">
  <thead>
    <tr>
        <th class="border border-gray-300">Reservation ID</th>
        <th class="border border-gray-300">Resource ID</th>
        <th class="border border-gray-300">Reservation Date</th>
        <th class="border border-gray-300">Schedule</th>
        <th class="border border-gray-300">Status</th>
        <th class="border border-gray-300">Date Created</th>
        <th class="border border-gray-300">Date Updated</th>
        <th class="border border-gray-300">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($reservations as $reserve)
        <tr>
        <td class="border border-gray-300">{{ $reserve->id }}</td>

<!-- Also fix resource id part to display resource name since on the table this is a foreign key -->
        <td class="border border-gray-300">{{ $reserve->resource_id }}</td>
        <td class="border border-gray-300">{{ $reserve->reservation_date }}</td>

<!-- Fix this part by either retrieving schedule data or showing N/A -->
        <td class="border border-gray-300">
        @if($reserve->schedule)
            {{ \Carbon\Carbon::parse($reserve->schedule->start_time)->format('g:i A') }} 
            - 
            {{ \Carbon\Carbon::parse($reserve->schedule->end_time)->format('g:i A') }}
        @else
            N/A
        @endif
        </td>
        <td class="border border-gray-300">{{ $reserve->status }}</td>
        <td class="border border-gray-300">{{ $reserve->created_at }}</td>
        <td class="border border-gray-300">{{ $reserve->updated_at }}</td>
        <td class="border border-gray-300">
            <form action="{{ route('reservations.show', $reserve->id) }}" method="GET" class="inline">
                <button type="submit" class="text-blue-500">View</button>
            </form>
            <form action="{{ route('reservations.edit', $reserve->id) }}" method="GET" class="inline">
                <button type="submit" class="text-green-500 ml-2">Edit</button>
            </form>
            <form action="{{ route('reservations.destroy', $reserve->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 ml-2">Cancel Reservation</button>
            </form>
        </td>
        </tr>
    @endforeach
  </tbody>
</table>




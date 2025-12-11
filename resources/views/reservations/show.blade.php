<div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
    <div class="mb-6 border-b pb-4">
        <h1 class="text-xl font-bold text-gray-900">
            Reservation Details #{{ $reservation->id }}
        </h1>
        <p class="text-sm text-gray-500">
            Booked by: <span class="font-medium text-gray-700">{{ $reservation->user->name }}</span>
        </p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        
        <div>
            <dt class="text-sm font-medium text-gray-500">Resource ID</dt>
            <dd class="mt-1 text-lg text-gray-900">{{ $reservation->resource_id }}</dd>
        </div>

        <div>
            <dt class="text-sm font-medium text-gray-500">Schedule ID</dt>
            <dd class="mt-1 text-lg text-gray-900">{{ $reservation->schedule_id }}</dd>
        </div>

        <div>
            <dt class="text-sm font-medium text-gray-500">Reservation Date</dt>
            <dd class="mt-1 text-lg text-gray-900">{{ $reservation->reservation_date }}</dd>
        </div>

        <div>
            <dt class="text-sm font-medium text-gray-500">Time Slot</dt>
            <dd class="mt-1 text-lg text-gray-900">
                @if($reservation->schedule)
                    {{ \Carbon\Carbon::parse($reservation->schedule->start_time)->format('g:i A') }} 
                    - 
                    {{ \Carbon\Carbon::parse($reservation->schedule->end_time)->format('g:i A') }}
                @else
                    <span class="text-red-500">N/A</span>
                @endif
            </dd>
        </div>

        <div>
            <dt class="text-sm font-medium text-gray-500">Status</dt>
            <dd class="mt-1 text-lg">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    {{ ucfirst($reservation->status) }}
                </span>
            </dd>
        </div>

        <div>
            <dt class="text-sm font-medium text-gray-500">Date Created</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $reservation->created_at->format('M d, Y') }}</dd>
        </div>

        <div>
            <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $reservation->updated_at->format('M d, Y') }}</dd>
        </div>

        <div class="col-span-2 mt-4 flex gap-2">
            <form action="{{ route('reservations.edit', $reservation->id) }}" method="GET" class="inline">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</button>
            </form>
            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancel Reservation</button>
            </form>
            <form action="{{ route('reservations.index') }}" method="GET" class="inline">
                <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to Reservations</button>
            </form>
        </div>
</div>
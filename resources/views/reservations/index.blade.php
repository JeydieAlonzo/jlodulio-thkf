<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8 py-8">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                {{-- Optional: Dynamic Title based on filter --}}
                @if(request('section_id'))
                    Section Bookings
                @else
                    Reservations
                @endif
            </h2>
            
            {{-- HIDE THIS BUTTON if the user is NOT a student (ID 1) --}}
            @if(auth()->user()->usertype_id == 1)
                <a href="{{ route('sections.index')}}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition duration-150 ease-in-out">
                    + Create New Reservation
                </a>
            @endif
        </div>

        <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal bg-white">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left">Reservation ID</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left">Resource Name</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center">Reservation Date</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center">Schedule</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center">Status</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center">Date Created</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center">Date Updated</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reserve)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                            
                            <td class="px-5 py-5 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap font-medium">{{ $reserve->id }}</p>
                            </td>

                            <td class="px-5 py-5 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{-- Checks for 'resource_name', falls back to 'name', then 'N/A' --}}
                                    {{ $reserve->resource->resource_name ?? $reserve->resource->name ?? 'N/A' }}
                                </p>
                            </td>

                            <td class="px-5 py-5 text-sm text-center">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $reserve->reservation_date }}
                                </p>
                            </td>

                            <td class="px-5 py-5 text-sm text-center">
                                <span class="bg-gray-100 text-gray-800 py-1 px-2 rounded-full text-xs">
                                    @if($reserve->schedule)
                                        {{ \Carbon\Carbon::parse($reserve->schedule->start_time)->format('g:i A') }} 
                                        - 
                                        {{ \Carbon\Carbon::parse($reserve->schedule->end_time)->format('g:i A') }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </td>

                            <td class="px-5 py-5 text-sm text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $reserve->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                      ($reserve->status === 'cancelled' || $reserve->status === 'declined' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ ucfirst($reserve->status) }}
                                </span>
                            </td>

                            <td class="px-5 py-5 text-sm text-center text-gray-500">
                                {{ $reserve->created_at->format('M d, Y') }}
                            </td>

                            <td class="px-5 py-5 text-sm text-center text-gray-500">
                                {{ $reserve->updated_at->format('M d, Y') }}
                            </td>

                            <td class="px-5 py-5 text-sm text-center">
                                <div class="flex items-center justify-center space-x-3">
                                    
                                    {{-- View Button --}}
                                    <form action="{{ route('reservations.show', $reserve->id) }}" method="GET" class="inline">
                                        <button type="submit" class="text-blue-600 hover:text-blue-900 font-medium hover:underline">View</button>
                                    </form>
                                    
                                    {{-- Edit Button (Hidden for Students) --}}
                                    @if(auth()->user()->usertype_id != 1)
                                        <form action="{{ route('reservations.edit', $reserve->id) }}" ...>
                                            <button>Edit</button>
                                        </form>
                                    @endif

                                    {{-- Delete Button (Only for Admins) --}}

                                    @if(auth()->user()->usertype_id == 3)
                                    <form action="{{ route('reservations.destroy', $reserve->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to permanently delete this reservation? This cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                    
                                    {{-- Cancel Logic --}}
                                    @php
                                        // 1. Get date/time
                                        $date = $reserve->reservation_date;
                                        $time = $reserve->schedule->start_time ?? '00:00:00';  
                                        
                                        // 2. Parse
                                        $startDateTime = \Carbon\Carbon::parse($date . ' ' . $time);
                                        $isFuture = $startDateTime->isFuture();
                                        
                                        // 3. Logic: Pending/Approved AND Future
                                        $canCancel = in_array($reserve->status, ['pending', 'approved']) && $isFuture;
                                    @endphp

                                    @if($canCancel)
                                        <form action="{{ route('reservations.cancel', $reserve->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            {{-- Converted to Tailwind Text Link style --}}
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium hover:underline">
                                                Cancel
                                            </button>
                                        </form>
                                    @else
                                        {{-- Disabled State --}}
                                        <span class="text-gray-400 cursor-not-allowed font-medium" title="Cannot cancel past or cancelled reservations">
                                            {{ $isFuture ? 'Cancel' : 'Passed' }}
                                        </span>
                                    @endif

                                </div>
                            </td>

                        </tr>

                    @endforeach
                </tbody>
            </table>
            
            @if($reservations->isEmpty())
                <div class="px-5 py-5 text-center text-gray-500 text-sm">
                    No reservations found.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
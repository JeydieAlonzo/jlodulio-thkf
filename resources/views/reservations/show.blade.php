<x-app-layout>
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
            
            {{-- 1. Changed Resource ID to Resource Type --}}
            <div>
                <dt class="text-sm font-medium text-gray-500">Resource Type</dt>
                <dd class="mt-1 text-lg text-gray-900">
                    {{-- Try 'resource_type', fall back to 'name', or 'N/A' if missing --}}
                    {{ $reservation->resource->resource_type ?? $reservation->resource->name ?? 'N/A' }}
                </dd>
            </div>
    
            {{-- 2. REMOVED Schedule ID --}}
    
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
                <dt class="text-sm font-medium text-gray-500">Actual Session Time</dt>
                <dd class="mt-1 text-lg text-gray-900">
                    @if($reservation->reservation_start_time)
                        {{-- Format: 4:00 PM --}}
                        <span class="font-bold text-blue-700">
                            {{ \Carbon\Carbon::parse($reservation->reservation_start_time)->format('g:i A') }}
                        </span>
                        
                        @if($reservation->reservation_end_time)
                            - 
                            <span class="font-bold text-blue-700">
                                {{ \Carbon\Carbon::parse($reservation->reservation_end_time)->format('g:i A') }}
                            </span>
                        @else
                            {{-- If start exists but end is empty --}}
                            <span class="text-xs text-green-600 font-bold uppercase ml-2">(Ongoing)</span>
                        @endif
                    @else
                        <span class="text-gray-400 italic">Not recorded</span>
                    @endif
                </dd>
            </div>
    
            <div>
                <dt class="text-sm font-medium text-gray-500">Status</dt>
                <dd class="mt-1 text-lg">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $reservation->status === 'approved' ? 'bg-green-100 text-green-800' : 
                          ($reservation->status === 'cancelled' || $reservation->status === 'declined' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst($reservation->status) }}
                    </span>
                </dd>
            </div>

            {{-- 3. ADDED Reservation Details (Description) --}}
            <div class="col-span-2">
                <dt class="text-sm font-medium text-gray-500">Reservation Details</dt>
                <dd class="mt-1 text-lg text-gray-900">
                    {{ $reservation->reservation_description ?? 'No additional details provided.' }}
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
    
            {{-- Action Buttons Area --}}
            <div class="col-span-2 md:col-span-4 mt-4 flex gap-2 border-t pt-4">
                
                {{-- 4. Edit Button: HIDDEN for Students (ID 1) --}}
                @if(auth()->user()->usertype_id != 1)
                    <form action="{{ route('reservations.edit', $reservation->id) }}" method="GET" class="inline">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                    </form>
                @endif

                {{-- DELETE BUTTON (Visible ONLY to Admin ID 3) --}}
                @if(auth()->user()->usertype_id == 3)
                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to PERMANENTLY delete this reservation?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                @endif
                
                {{-- 5. Cancel Button: Uses the Logic from Index --}}
                @php
                    // Calculate if the reservation is in the future
                    $dateString = $reservation->reservation_date . ' ' . ($reservation->schedule->start_time ?? '00:00:00');
                    $startDateTime = \Carbon\Carbon::parse($dateString);
                    $isFuture = $startDateTime->isFuture();
                    
                    // Allow cancel only if status is valid AND time is in the future
                    $canCancel = in_array($reservation->status, ['pending', 'approved']) && $isFuture;
                @endphp

                @if($canCancel)
                    <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Cancel Reservation
                        </button>
                    </form>
                @else
                    {{-- Greyed out button if they can't cancel --}}
                    <button type="button" class="bg-gray-300 text-gray-500 font-bold py-2 px-4 rounded cursor-not-allowed" disabled>
                        {{ $reservation->status == 'cancelled' ? 'Cancelled' : 'Cannot Cancel' }}
                    </button>
                @endif

                <form action="{{ route('reservations.index') }}" method="GET" class="inline">
                    <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to Reservations</button>
                </form>
            </div>

            <div class="mb-6 border-b pb-4">
                <h1 class="text-xl font-bold text-gray-900">
                    Reservation Details #{{ $reservation->id }}
                </h1>

                {{-- BASIC INFO (Visible to Everyone) --}}
                <p class="text-sm text-gray-500">
                    Booked by: <span class="font-medium text-gray-700">{{ $reservation->user->name }}</span>
                </p>

                {{-- LIBRARIAN ONLY: Detailed Contact Info --}}
                @if(auth()->user()->usertype_id == 2)
                    <div class="mt-4 bg-blue-50 p-4 rounded-md border border-blue-100">
                        <h3 class="text-sm font-bold text-blue-800 uppercase tracking-wide mb-2">
                            Student Contact Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            
                            <div>
                                <span class="text-gray-500 block">Full Name</span>
                                <span class="font-medium text-gray-900">{{ $reservation->user->name }}</span>
                            </div>

                            <div>
                                <span class="text-gray-500 block">Email Address</span>
                                <span class="font-medium text-gray-900">{{ $reservation->user->email }}</span>
                            </div>

                            <div>
                                <span class="text-gray-500 block">Phone Number</span>
                                {{-- Check if 'phone' or 'mobile_number' exists in your Users table --}}
                                <span class="font-medium text-gray-900">
                                    {{ $reservation->user->phone ?? $reservation->user->contact_number ?? 'N/A' }}
                                </span>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
    </div>
</x-app-layout>
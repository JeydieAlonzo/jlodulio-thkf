<x-app-layout>
    <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Manage Reservation #{{ $reservation->id }}</h2>

            <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- READ ONLY INFO (Student Name, Scheduled Date, etc.) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Student Name</label>
                        <input type="text" value="{{ $reservation->user->name }}" disabled 
                            class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Scheduled Date</label>
                        <input type="text" value="{{ $reservation->reservation_date }}" disabled 
                            class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <hr class="my-6">

                {{-- LIBRARIAN CONTROLS --}}
                <div class="space-y-4">
                    
                    {{-- 1. Status Dropdown --}}
                    <div>
                        <label for="status" class="block text-sm font-bold text-gray-700">Update Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $reservation->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="declined" {{ $reservation->status == 'declined' ? 'selected' : '' }}>Declined</option>
                            <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    {{-- 2. NEW: Actual Session Time Tracking --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="reservation_start_time" class="block text-sm font-bold text-gray-700">Actual Start Time</label>
                            <input type="time" name="reservation_start_time" id="reservation_start_time" 
                                value="{{ $reservation->reservation_start_time }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="reservation_end_time" class="block text-sm font-bold text-gray-700">Actual End Time</label>
                            <input type="time" name="reservation_end_time" id="reservation_end_time" 
                                value="{{ $reservation->reservation_end_time }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>

                    {{-- 3. Notes --}}
                    <div>
                        <label for="reservation_description" class="block text-sm font-bold text-gray-700">Librarian Notes</label>
                        <textarea name="reservation_description" id="reservation_description" rows="3" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Add notes...">{{ $reservation->reservation_description }}</textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('reservations.index') }}" class="text-gray-600 underline mr-4">Cancel</a>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow">
                        Update Session
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
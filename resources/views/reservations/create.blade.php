<form action="{{ route('reservations.store') }}" method="post" class="max-w-md mx-auto p-4 bg-white shadow rounded-lg">
    @csrf

    {{-- 1. RESOURCE SELECTION --}}
    <div class="mb-4">
        <label for="resource_id" class="block font-medium text-sm text-gray-700">Type of Reservation:</label>
        <select name="resource_id" id="resource_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
            <option value="" disabled selected>Select a resource...</option>
            <option value="1">Chairs</option>       <option value="2">Material Use</option> </select>
    </div>

    {{-- 2. TIME SLOT SELECTION (SCHEDULE) --}}
    <div class="mb-4">
        <label for="schedule_id" class="block font-medium text-sm text-gray-700">Time Slot:</label>
        <select name="schedule_id" id="schedule_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
            <option value="" disabled selected>Select a time...</option>
            <option value="1">8:00 AM - 11:00 AM</option>
            <option value="2">11:00 AM - 2:00 PM</option>
            <option value="3">2:00 PM - 5:00 PM</option>
        </select>
    </div>

    {{-- 3. DATE SELECTION --}}
    <div class="mb-4">
        <label for="reservation_date" class="block font-medium text-sm text-gray-700">Reservation Date:</label>
        <input type="date" id="reservation_date" name="reservation_date" 
               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" 
               required>
    </div>

    <div class="flex items-center justify-end mt-4">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Submit Reservation
        </button>
    </div>
</form>
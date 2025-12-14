<x-app-layout>

<form action="{{ route('reservations.store') }}" method="post" class="max-w-md mx-auto p-4 bg-white shadow rounded-lg">
    @csrf

    {{-- HIDDEN FIELD: Keep the section ID if you have one --}}
    @if(request('section_id'))
        <input type="hidden" name="section_id" value="{{ request('section_id') }}">
    @endif

    {{-- 1. RESOURCE SELECTION (Dynamic Dropdown) --}}
    <div class="mb-4">
        <label class="block font-medium text-sm text-gray-700 mb-2">Select Resource</label>
        <select name="resource_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
            
            {{-- Placeholder: Select if old input is null --}}
            <option value="" disabled @selected(old('resource_id') == null)>Select a resource...</option>

            @if($resources->isEmpty())
                <option value="" disabled>No resources available</option>
            @else
                @foreach($resources as $resource)
                    <option value="{{ $resource->id }}" 
                        {{-- FIX: Check if this ID matches the old input --}}
                        @selected(old('resource_id') == $resource->id)>
                        
                        {{ $resource->full_label ?? $resource->resource_name }}
                    </option>
                @endforeach
            @endif
        </select>
        @error('resource_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- 2. DESCRIPTION (Textarea) --}}
    <div class="mb-4">
        <label for="reservation_description" class="block font-medium text-sm text-gray-700">Description (Optional):</label>
        
        {{-- FIX: old() goes BETWEEN the tags, NOT in value="" --}}
        <textarea id="reservation_description" name="reservation_description" rows="3" 
                  class="border-gray-300 rounded-md shadow-sm block mt-1 w-full" 
                  placeholder="Provide details for the material to be reserved for use (leave blank if unapplicable)...">{{ old('reservation_description') }}</textarea>
                  
        @error('reservation_description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- 3. TIME SLOT (Static Dropdown) --}}
    <div class="mb-4">
        <label for="schedule_id" class="block font-medium text-sm text-gray-700">Time Slot:</label>
        <select name="schedule_id" id="schedule_id" class="border-gray-300 rounded-md shadow-sm block mt-1 w-full" required>
            
            {{-- Placeholder --}}
            <option value="" disabled @selected(old('schedule_id') == null)>Select a time...</option>
            
            {{-- Options: We compare using == to handle '1' vs 1 --}}
            <option value="1" @selected(old('schedule_id') == 1)>8:00 AM - 11:00 AM</option>
            <option value="2" @selected(old('schedule_id') == 2)>11:00 AM - 2:00 PM</option>
            <option value="3" @selected(old('schedule_id') == 3)>2:00 PM - 5:00 PM</option>
        </select>

        {{-- Error Message for Double Booking --}}
        @error('schedule_id')
            <p class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</p>
        @enderror
    </div>

    {{-- 4. DATE SELECTION (Input) --}}
    <div class="mb-4">
        <label for="reservation_date" class="block font-medium text-sm text-gray-700">Reservation Date:</label>
        
        {{-- FIX: Add value="{{ old(...) }}" --}}
        <input type="date" id="reservation_date" name="reservation_date" 
               value="{{ old('reservation_date') }}"
               class="border-gray-300 rounded-md shadow-sm block mt-1 w-full" 
               required>
               
        @error('reservation_date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Submit Reservation
        </button>
    </div>
</form>
</x-app-layout>
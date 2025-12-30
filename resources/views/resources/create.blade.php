<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Resource</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Global Error Display --}}
                @if ($errors->any())
                    <div class="alert alert-danger mb-4 p-4 bg-red-100 text-red-700 border-l-4 border-red-500 rounded">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('resources.store') }}" method="POST">
                    @csrf 

                    {{-- 1. Resource Name --}}
                    <div class="mb-3">
                        <label class="block font-medium text-gray-700">Resource Name</label>
                        <input type="text" name="resource_name" value="{{ old('resource_name') }}" 
                               class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full" required>
                        @error('resource_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- 2. Resource Type --}}
                    <div class="mb-3">
                        <label class="block font-medium text-gray-700">Type</label>
                        <input type="text" name="resource_type" value="{{ old('resource_type') }}" 
                               class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full" required>
                        @error('resource_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- 3. Availability (Optional) --}}
                    <div class="mb-3">
                        <label class="block font-medium text-gray-700">Availability / Status</label>
                        <input type="text" name="availability" value="{{ old('availability') }}" 
                               class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full" 
                               placeholder="e.g. Available, Under Repair">
                    </div>

                    {{-- 4. Section Dropdown (THE FIX IS HERE) --}}
                    <div class="mb-3">
                        <label class="block font-medium text-gray-700">Assign to Section</label>
                        
                        {{-- Name MUST be 'section_id' to match the Controller validation --}}
                        <select name="section_id" class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full" required>
                            <option value="">-- Select a Section --</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                    {{ $section->section_name }}
                                </option>
                            @endforeach
                        </select>
                        
                        @error('section_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- 5. Description --}}
                    <div class="mb-3">
                        <label class="block font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="3" class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full">{{ old('description') }}</textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save Resource</button>
                        <a href="{{ route('resources.index') }}" class="ml-3 text-gray-600">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Section') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- 
                Note: x-app-layout usually uses Tailwind CSS. 
                I kept your Bootstrap classes (container, btn), but 
                they might conflict or look plain if Bootstrap isn't loaded 
                in your main layout file.
            --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Error Handling --}}
                @if ($errors->any())
                    <div class="alert alert-danger mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('sections.store') }}" method="POST">
                    @csrf 

                    <div class="mb-3">
                        <label for="section_name" class="form-label block font-medium text-gray-700">Section Name</label>
                        <input 
                            type="text" 
                            class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" 
                            id="section_name" 
                            name="section_name" 
                            value="{{ old('section_name') }}" 
                            required>
                    </div>

                    <div class="mb-3 mt-4">
                        <label for="description" class="form-label block font-medium text-gray-700">Description</label>
                        <textarea 
                            class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" 
                            id="description" 
                            name="description" 
                            rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded">Save Section</button>
                        <a href="{{ route('sections.index') }}" class="btn btn-secondary text-gray-600 ml-3">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
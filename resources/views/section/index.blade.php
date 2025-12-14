<x-app-layout>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Select a Library Section</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($sections as $section)
        <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 hover:shadow-lg transition">
            
            <h2 class="text-xl font-bold text-blue-600 mb-2">
                {{ $section->section_name }}
            </h2>
            
            <p class="text-gray-600 mb-4 h-16 overflow-hidden">
                {{ $section->description ?? 'No description available.' }}
            </p>

            <a href="{{ route('reservations.create', ['section_id' => $section->section_id]) }}" 
               class="block w-full text-center bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
               Enter & Reserve
            </a>

        </div>
        @endforeach
    </div>
</div>

<!-- I think this didn't get used because it's already covered in dashboard.blade.php -->

</x-app-layout>
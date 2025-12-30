<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- First Name --}}
                        <div>
                            <label class="block font-medium text-gray-700">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        {{-- Last Name --}}
                        <div>
                            <label class="block font-medium text-gray-700">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        {{-- Username --}}
                        <div>
                            <label class="block font-medium text-gray-700">Username</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full" required>
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block font-medium text-gray-700">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full" required>
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Password (Optional) --}}
                        <div>
                            <label class="block font-medium text-gray-700">New Password <span class="text-gray-400 text-xs font-normal">(Leave blank to keep current)</span></label>
                            <input type="password" name="password" class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full">
                            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label class="block font-medium text-gray-700">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full">
                        </div>

                        {{-- Contact Number --}}
                        <div>
                            <label class="block font-medium text-gray-700">Contact Number</label>
                            <input type="text" name="contact_number" value="{{ old('contact_number', $user->contact_number) }}" class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full">
                        </div>

                        {{-- User Role --}}
                        <div class="md:col-span-2">
                            <label class="block font-medium text-gray-700">User Role</label>

                            @php
                                $roles = [
                                    1 => 'Student',
                                    2 => 'Teacher / Librarian',
                                    3 => 'Admin',
                                ];
                            @endphp

                            <select name="usertype_id" class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full" required>
                                @foreach($roles as $id => $label)
                                    <option value="{{ $id }}" 
                                        {{-- Check OLD input first (if validation failed), otherwise check DATABASE value --}}
                                        {{ (old('usertype_id', $user->usertype_id) == $id) ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update User</button>
                        <a href="{{ route('users.index') }}" class="ml-3 text-gray-600">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
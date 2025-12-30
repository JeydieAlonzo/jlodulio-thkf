<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType; // Make sure this Model exists
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load userType to prevent N+1 queries
        // Assumes User model has a 'userType' relationship defined
        $users = User::with('userType')->paginate(10);
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch roles for the dropdown
        $userTypes = UserType::all();
        
        return view('users.create', compact('userTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:255', 'unique:users'],
            'email'          => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'       => ['required', 'confirmed', 'min:8'],
            'first_name'     => ['required', 'string', 'max:255'],
            'last_name'      => ['required', 'string', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:20'],
            'usertype_id'    => ['required', 'integer', 'in:1,2,3'],
        ]);

        // Hash the password before saving
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $userTypes = UserType::all();
        return view('users.edit', compact('user', 'userTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            // Ignore current user ID for unique checks
            'name'           => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email'          => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'first_name'     => ['required', 'string', 'max:255'],
            'last_name'      => ['required', 'string', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:20'],
            'usertype_id'    => ['required', 'integer', 'in:1,2,3'],
            
            // Password is optional during update
            'password'       => ['nullable', 'confirmed', 'min:8'],
        ]);

        // Only update password if a new one was provided
        if (filled($request->password)) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']); // Remove from array so we don't overwrite with null
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting yourself (optional safety check)
        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
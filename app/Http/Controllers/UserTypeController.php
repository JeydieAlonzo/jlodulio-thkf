<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usertypes = UserType::paginate(10);
        return view('usertypes.index', compact('usertypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usertypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|string|max:255',
        ]);

        UserType::create($request->all());

        return redirect()->route('usertypes.index')
                         ->with('success', 'User type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserType $usertype)
    {
        return view('usertypes.show', compact('usertype'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserType $usertype)
    {
        return view('usertypes.edit', compact('usertype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserType $usertype)
    {
        $request->validate([
            'role' => 'required|string|max:255', $usertype->id
        ]);

        $usertype->update($request->all());

        return redirect()->route('usertypes.index')
                         ->with('success', 'User type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserType $usertype)
    {
        $usertype->delete();

        return redirect()->route('usertypes.index')
                         ->with('success', 'User type deleted successfully.');
    }
}

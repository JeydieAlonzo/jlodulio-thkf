<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use App\Models\Section;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = Resource::with('section')->paginate(10);
        return view('resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('resources.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'resource_name'      => 'required|string|max:255',
            'resource_type'      => 'required|string|max:255',
            'description'        => 'nullable|string',
            'availability'       => 'nullable|string', // added since it's in your fillable
            'section_id' => 'required|exists:sections,id', // Matches form input name
        ]);

        Resource::create($validated);

        return redirect()->route('resources.index')->with('success', 'Resource created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        $resource->load('section'); 
        return view('resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        $sections = Section::all();
        return view('resources.edit', compact('resource', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        $validated = $request->validate([
            'resource_name'      => 'required|string|max:255',
            'resource_type'      => 'required|string|max:255',
            'description'        => 'nullable|string',
            'availability'       => 'nullable|string',
            'section_id' => 'required|exists:sections,id',
        ]);

        $resource->update($validated);

        return redirect()->route('resources.index')->with('success', 'Resource updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();
        return redirect()->route('resources.index')->with('success', 'Resource deleted successfully.');
    }
}

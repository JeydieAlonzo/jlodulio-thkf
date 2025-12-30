<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = \App\Models\Section::paginate(10);
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'section_name' => 'required|string|max:255|unique:sections,section_name',
        'description' => 'nullable|string|max:1000',
        ]);

        // 2. Create the Section
        Section::create($validated);

        // 3. Redirect user back (usually to the list)
        return redirect()->route('sections.index')->with('success', 'Section created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return view('sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
                // Unique check ignores the current section's ID so you don't get an error if you keep the name the same
                'section_name' => 'required|string|max:255|unique:sections,section_name,' . $section->id,
                'description' => 'nullable|string|max:1000',
            ]);

            $section->update($validated);

            return redirect()->route('sections.index')->with('success', 'Section updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index')->with('success', 'Section deleted successfully.');
    }
}

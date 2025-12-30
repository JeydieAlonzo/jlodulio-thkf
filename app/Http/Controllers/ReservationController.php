<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- Added this line for Authenticated User handling like when creating a reservation the student_user_id is set to Auth::id()
use App\Models\Resource; // <--- Added this line because data from Resource in its model is needed through foreign keys and relationships
use App\Models\Schedule; // <--- Added this line because data from Schedule in its model is needed through foreign keys and relationships
use App\Models\Section; // <--- Added this line to reference Section model
use Carbon\Carbon; // <--- ADD THIS LINE (For date-time handling)

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = \App\Models\Reservation::with(['schedule', 'resource']);

        // catches the section_id from the URL if present
        
        // 1. Check if 'section_id' is passed in the URL for filtering
        if ($request->has('section_id')) {
            $sectionId = $request->input('section_id');
            
            $query->whereHas('resource', function($q) use ($sectionId) {
                $q->where('section_id', $sectionId);
            });
        }

        // 2. Usertype-based filtering that applies to ALL views

        if ($user->usertype_id == 1) {
            // Students should only see their own reservations
            $query->where('student_user_id', $user->id);
        } 
        // Librarians (ID 2): They see everything if they went to '/reservations', OR the filtered list above if they clicked a section.

        $reservations = $query->orderBy('reservation_date', 'desc')->get();

        return view('reservations.index', compact('reservations'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) // <--- Add Request $request
    {
         // 1. Check if the URL has ?section_id=5
        $sectionId = $request->query('section_id');

        // 2. Fetch the Section details (so we can show the name "Archives" on the form)
        // If ID is missing/invalid, this returns null
        $section = Section::find($sectionId);

        // 2. Filter the Dropdown
        if ($sectionId) {
            // "Automated": Only show resources belonging to that section
            $resources = Resource::where('section_id', $sectionId)->get();
        }
        else {
        // Fallback: Show everything if they somehow skipped the section page
        $resources = Resource::all();
        }

        // Load schedules as normal
        $schedules = \App\Models\Schedule::all(); 

        return view('reservations.create', compact('resources', 'schedules', 'sectionId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $isBooked = Reservation::where('resource_id', $request->input('resource_id'))
            ->where('schedule_id', $request->input('schedule_id'))
            ->where('reservation_date', $request->input('reservation_date'))
            ->exists();

        if ($isBooked) {
            return redirect()->back()->withInput()->withErrors(['schedule_id' => 'The selected resource is already booked at that time. Please choose a different time or resource.']);
        }
        
        $data = [
            'student_user_id' => Auth::id(),
            'resource_id' => $request->input('resource_id'),
            'schedule_id' => $request->input('schedule_id'),
            'reservation_date' => $request->input('reservation_date'),
            'status' => 'pending',
            'reservation_description' => $request->input('reservation_description'),
        ];

        Reservation::create($data);
        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        // 1. SECURITY: Block Students (ID 1) immediately
        if (auth()->user()->usertype_id == 1) {
            abort(403, 'Students are not allowed to edit reservations.');
        }

        $reservation = \App\Models\Reservation::findOrFail($reservation->id);
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
{
    $user = auth()->user();

    if ($user->usertype_id == 1) {
        abort(403, 'Unauthorized.');
    }

    $validated = $request->validate([
        'status' => 'required',
        'reservation_description' => 'nullable',
        'reservation_start_time' => 'nullable', 
        'reservation_end_time'   => 'nullable',
    ]);

    // Format times
    $start = $validated['reservation_start_time'] ? \Carbon\Carbon::parse($validated['reservation_start_time'])->format('H:i:s') : null;
    $end   = $validated['reservation_end_time']   ? \Carbon\Carbon::parse($validated['reservation_end_time'])->format('H:i:s') : null;

    // NUCLEAR OPTION: Direct Database Update (Bypasses Model & Casting)
    \DB::table('reservations')
        ->where('id', $reservation->id)
        ->update([
            'status' => $validated['status'],
            'reservation_description' => $validated['reservation_description'],
            'reservation_start_time' => $start,
            'reservation_end_time' => $end,
            'librarian_user_id' => $user->id,
            'updated_at' => now(),
        ]);

    // 1. Find out which section this reservation belongs to
    // (Assuming Reservation -> belongsTo Resource -> belongsTo Section)
    $sectionId = $reservation->resource->section_id;

    // 2. Redirect back to the index, but attached the 'section_id' filter
    return redirect()->route('reservations.index', ['section_id' => $sectionId])
        ->with('message', 'Reservation updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        // 1. SECURITY: Only Admins (Type 3) can delete
        if (auth()->user()->usertype_id != 3) {
            abort(403, 'Unauthorized. Only Administrators can delete reservations.');
        }

        // 2. Find and Delete
        $reservation = \App\Models\Reservation::findOrFail($reservation->id);
        $reservation->delete();

        return redirect()->route('reservations.index')
        ->with('message', 'Reservation deleted successfully.');
    }

    public function cancel($id)
    {
        $reservation = Reservation::find($id);

        // 1. Define 'now'
        $currentTime = now();

        // 2. Parse the reservation start time (assuming column is 'start_time')
        // If your date and time are in separate columns, combine them: 
        // $reservationStart = \Carbon\Carbon::parse($reservation->date . ' ' . $reservation->time);
        $reservationStart = Carbon::parse($reservation->date . ' ' . $reservation->time);

        // 3. LOGIC: 
        // Status is Pending OR Approved 
        // AND the reservation hasn't started yet
        if (in_array($reservation->status, ['pending', 'approved']) && $reservationStart->gt($currentTime)) {
            
            $reservation->status = 'cancelled';
            $reservation->save();

            return redirect()->back()->with('message', 'Reservation cancelled successfully.');
        }

        return redirect()->back()->with('error', 'You cannot cancel a reservation that has already started or is completed.');
    }
}

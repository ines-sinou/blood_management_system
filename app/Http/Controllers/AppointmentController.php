<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        // Fetch hospitals for dropdown
        $hospitals = Hospital::all();

        // Fetch appointments for the logged-in donor
        $appointments = Appointment::where('user_id', Auth::id())->get();

        // Format events for FullCalendar
      $events = Appointment::with('hospital', 'donor')->get()->map(function($appointment) {
    return [
        'id' => $appointment->id,
        'title' => $appointment->hospital->name, // or donor's name
        'start' => $appointment->appointment_date,
        'status' => $appointment->status,
        'notes' => $appointment->notes,
        'color' => match($appointment->status) {
            'confirmed' => '#28a745', // green
            'pending' => '#ffc107',   // yellow
            'cancelled' => '#dc3545', // red
            default => '#0d6efd'
        }
    ];
});


        return view('donor.dashboard', compact('hospitals', 'events'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
        ]);

        // Create appointment
        $appointment = Appointment::create([
            'user_id' => Auth::id(),
            'hospital_id' => $request->hospital_id,
            'appointment_date' => $request->appointment_date,
            'notes' => $request->notes,
            'status' => 'pending', // default
        ]);

        return redirect()->route('donor.dashboard')->with('success', 'Appointment booked successfully.');
    }
}

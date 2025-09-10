<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\User;

class LabTechnicianController extends Controller
{
    /**
     * Lab technician dashboard:
     * - See appointments for their hospital
     * - See donors who have appointments in their hospital
     */
    public function dashboard()
    {
        $hospitalId = Auth::user()->hospital_id; // ✅ make sure labtech user has hospital_id

        // Fetch appointments for this hospital
        $appointments = Appointment::where('hospital_id', $hospitalId)
            ->with('donor') // eager load donor info
            ->orderBy('appointment_date')
            ->get();

        // Fetch donors who have appointments at this hospital
        $donors = User::where('role_id', 4) // role_id = 4 → donor
            ->whereHas('appointments', function ($query) use ($hospitalId) {
                $query->where('hospital_id', $hospitalId);
            })
            ->get();

        return view('lab_technician.dashboard', compact('appointments', 'donors'));
    }

    /**
     * Confirm appointment
     */
    public function confirm(Appointment $appointment)
    {
        $appointment->update(['status' => 'validated']); // ✅ use "validated" to match your migration
        return back()->with('success', 'Appointment confirmed.');
    }

    /**
     * Reject appointment
     */
    public function reject(Appointment $appointment)
    {
        $appointment->update(['status' => 'cancelled']); // ✅ use "cancelled" to match your migration
        return back()->with('error', 'Appointment rejected.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Donor;


class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        // Only donors with completed profiles
        $donors = Donor::where('profile_completed', true)->get();
        return view('lab_technician.dashboard', compact('donors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
          return view('donors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
             $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:donors,email',
            'phone' => 'required',
            'blood_group' => 'required',
        ]);
     
            Donor::create([
            'user_id' => Auth::id(), // link to logged-in user
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'blood_group' => $request->blood_group,
            'dob' => $request->dob,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Profile created successfully!');
 }

    /**
     * Display the specified resource.
     */
    public function show(Donor $donor)
    {
        return view('donors.show', compact('donor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donor $donor)
    {
          return view('donors.edit', compact('donor'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Update existing donor profile
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'blood_group' => 'required',
        ]);

        $donor = Donor::where('user_id', Auth::id())->first();

        if ($donor) {
            $donor->update($request->all());
        } else {
            Donor::create(array_merge($request->all(), ['user_id' => Auth::id()]));
        }

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donor $donor)
    {
         $donor->delete();

        return redirect()->route('donors.index')
            ->with('success', 'Donor deleted.'); 
    }
    public function toggleStatus($id)
{
    $donor = Donor::findOrFail($id);

    $donor->status = $donor->status === 'active' ? 'blocked' : 'active';
    $donor->save();

    return redirect()->back()->with('success', 'Donor status updated!');
}
}

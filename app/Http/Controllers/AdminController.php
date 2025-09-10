<?php

// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Hospital;

class AdminController extends Controller
{
 public function dashboard()
{
    $hospitals = Hospital::with(['admin', 'memberships'])->get();
    $memberships = Membership::all(); // if needed in the form
    return view('admin.dashboard', compact('hospitals', 'memberships'));
}

}







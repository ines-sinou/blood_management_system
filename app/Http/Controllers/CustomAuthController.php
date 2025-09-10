<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class CustomAuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('custom_auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect based on role
            $roleName = $user->role->name ?? null;

            switch ($roleName) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'hospital_admin':
                    return redirect()->route('hospital.admin.dashboard');
               case 'labtech':
                    return redirect()->route('labtech.dashboard');
                case 'hospital_staff':
                    return redirect()->route('hospital.dashboard');
                case 'donor':
                default:
                    return redirect()->route('donor.dashboard');
            }

        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Show registration form
    public function showRegister()
    {
        $roles = Role::where('name', '!=', 'admin')->get(); // Exclude system admin from registration
        return view('custom_auth.register', compact('roles'));
    }

    // Handle registration
   public function register(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    // Get donor role
    $donorRole = Role::where('name', 'donor')->first();

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role_id'  => $donorRole?->id,   // ✅ assign role_id
    ]);

    Auth::login($user);

    return redirect()->route('donor.dashboard');
}

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.show');
    }
}

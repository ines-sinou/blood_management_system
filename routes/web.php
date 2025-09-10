<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\LabTechnicianController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\HospitalController;

// ------------------- Landing Page -------------------
Route::get('/', fn() => view('landing'))->name('home');

// ------------------- Authentication -------------------
Route::get('/login', [CustomAuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [CustomAuthController::class, 'login'])->name('login.custom');

Route::get('/register', [CustomAuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [CustomAuthController::class, 'register'])->name('register.custom');

Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');

// ------------------- Dashboards (Protected) -------------------
Route::middleware(['auth'])->group(function () {
    // Role-based dashboards
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/hospital-admin/dashboard', fn() => view('hospital_admin.dashboard'))->name('hospital.admin.dashboard');
    Route::get('/hospital/dashboard', fn() => view('hospital.dashboard'))->name('hospital.dashboard');
    Route::get('/donor/dashboard', [AppointmentController::class, 'index'])->name('donor.dashboard');
    Route::get('/labtech/dashboard', [LabTechnicianController::class, 'dashboard'])->name('labtech.dashboard');

    // ------------------- Donor Routes -------------------
    Route::middleware('role:donor')->group(function () {
        Route::get('/donor/appointments', [AppointmentController::class, 'index'])->name('donor.appointments.index');
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
        Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
        Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    });

    // ------------------- LabTech Routes -------------------
    Route::middleware('role:labtech')->group(function () {
        Route::get('/labtech/appointments', [LabTechnicianController::class, 'appointments'])->name('labtech.appointments');
        Route::post('/labtech/appointments/{appointment}/confirm', [LabTechnicianController::class, 'confirm'])->name('labtech.appointments.confirm');
        Route::post('/labtech/appointments/{appointment}/reject', [LabTechnicianController::class, 'reject'])->name('labtech.appointments.reject');
    });

    // ------------------- Donor Management -------------------
    Route::resource('donors', DonorController::class);
    Route::post('/donors/{id}/toggle-status', [DonorController::class, 'toggleStatus'])->name('donors.toggleStatus');

    // ------------------- Membership Management -------------------
    Route::resource('memberships', MembershipController::class);
});

Route::post('/hospitals', [HospitalController::class, 'store'])->name('hospitals.store');



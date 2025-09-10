<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Hospital;
use Illuminate\Support\Facades\Hash;

class HospitalStaffSeeder extends Seeder
{
    public function run()
    {
        // Fetch role IDs
        $adminRoleId = Role::where('name', 'hospital_admin')->first()->id;
        $staffRoleId = Role::where('name', 'hospital_staff')->first()->id;
        $labtechRoleId = Role::where('name', 'labtech')->first()->id;

        // Assign staff to hospitals
        $hospitals = Hospital::all();

        foreach ($hospitals as $hospital) {

            // Hospital admin
            User::create([
                'name' => $hospital->name . ' Admin',
                'email' => strtolower(str_replace(' ', '_', $hospital->name)) . '_admin@example.com',
                'password' => Hash::make('password'),
                'role_id' => $adminRoleId,
                'hospital_id' => $hospital->id,
            ]);

            // Staff
            for ($i = 1; $i <= 3; $i++) {
                User::create([
                    'name' => $hospital->name . " Staff $i",
                    'email' => strtolower(str_replace(' ', '_', $hospital->name)) . "_staff$i@example.com",
                    'password' => Hash::make('password'),
                    'role_id' => $staffRoleId,
                    'hospital_id' => $hospital->id,
                ]);
            }

            // Lab technicians
            for ($i = 1; $i <= 2; $i++) {
                User::create([
                    'name' => $hospital->name . " LabTech $i",
                    'email' => strtolower(str_replace(' ', '_', $hospital->name)) . "_labtech$i@example.com",
                    'password' => Hash::make('password'),
                    'role_id' => $labtechRoleId,
                    'hospital_id' => $hospital->id,
                ]);
            }
        }
    }
}

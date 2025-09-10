<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Test Admin',
                'password' => Hash::make('password'),
                'role_id' => 1, // Admin role
            ]
        );

        // Hospital Admin
        User::firstOrCreate(
            ['email' => 'hospitaladmin@example.com'],
            [
                'name' => 'Hospital Admin',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ]
        );

        // Lab Technician
        User::firstOrCreate(
            ['email' => 'labtech@example.com'],
            [
                'name' => 'Lab Technician',
                'password' => Hash::make('password'),
                'role_id' => 3,
            ]
        );

        // Donor
        User::firstOrCreate(
            ['email' => 'donor@example.com'],
            [
                'name' => 'John Donor',
                'password' => Hash::make('password'),
                'role_id' => 4,
            ]
        );

           // Hospital staff
        User::firstOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Jonh Staff',
                'password' => Hash::make('password'),
                'role_id' => 5,
            ]
        );

  

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hospital;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $hospitals = [
            ['name' => 'Central Hospital', 'region' => 'Centre'],
            ['name' => 'North Clinic', 'region' => 'North'],
            ['name' => 'South Health Center', 'region' => 'South'],
        ];

        foreach ($hospitals as $data) {
            Hospital::create($data);
        }
    }
}

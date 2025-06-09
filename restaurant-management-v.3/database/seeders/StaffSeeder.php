<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MsStaff;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        // database/seeders/StaffSeeder.php
        msstaff::create([
            'staffEmail' => 'admin@example.com',
            'staffPassword' => bcrypt('password123'),
        ]);
    }
}

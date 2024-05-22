<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    use WithoutModelEvents;
    public function run(): void
    {
        //  call to EmployeeSeeder
        $this->call([
            EmployeeSeeder::class,
        ]);
    }
}

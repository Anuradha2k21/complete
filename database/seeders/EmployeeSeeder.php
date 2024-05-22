<?php

namespace Database\Seeders;

use App\Models\Employee;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('employees')->insert([
        //     'name' => Str::random(10),
        //     'username' => Str::random(10),
        //     'email' => Str::random(10) . '@example.com',
        //     'password' => Hash::make('password'),
        //     'leave_count' => rand(2, 5),
        // ]);
        Employee::factory()
            ->count(50)
            ->create();
    }
}

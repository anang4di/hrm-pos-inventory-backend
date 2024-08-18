<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BasicSalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BasicSalary::create([
            'company_id' => 1,
            'user_id' => 1,
            'basic_salary' => 5000000.00,
        ]);
    }
}

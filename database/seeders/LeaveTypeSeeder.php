<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\LeaveType::create([
            'company_id' => 1,
            'name' => 'Anual Leave',
            'is_paid' => 1,
            'total_leaves' => 10,
            'created_by' => 1,
        ]);

        \App\Models\LeaveType::create([
            'company_id' => 1,
            'name' => 'Sick Leave',
            'is_paid' => 1,
            'total_leaves' => 10,
            'created_by' => 1,
        ]);

        \App\Models\LeaveType::create([
            'company_id' => 1,
            'name' => 'Unpaid Leave',
            'is_paid' => 0,
            'total_leaves' => 10,
            'created_by' => 1,
        ]);
    }
}

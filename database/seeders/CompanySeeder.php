<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Company::create([
            'name' => 'Wija Truss',
            'email' => 'marketing@wijatruss.com',
            'phone' => '(021) 29821015',
            'website' => 'https://wijatruss.com/',
            'logo' => '/logos/wija-logo.png',
            'address' => 'Jl. Jababeka XVIID Blok U No. 31D Desa Karang Baru, Kec. Cikarang Utara, Kab. Bekasi, Jawa Barat 17530',
            'status' => 'active',
            'total_users' => 1,
            'clock_in_time' => '09:00:00',
            'clock_out_time' => '18:00:00',
            'early_clock_in_time' => 15,
            'allow_clock_out_till' => 15,
            'self_clocking' => 1,
        ]);
    }
}

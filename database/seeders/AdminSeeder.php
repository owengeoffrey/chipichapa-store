<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Admin::create([
            'nama_lengkap' => 'Super Admin',
            'admin_id'     => 'ADMIN-001',
            'email'        => 'admin@gmail.com',
            'nomor_hp'     => '081234567890',
            'password'     => \Illuminate\Support\Facades\Hash::make('admin123'),
        ]);
    }
}

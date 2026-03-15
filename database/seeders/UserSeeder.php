<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::create([
            'nama_lengkap' => 'User Demo',
            'name'         => 'User Demo',
            'email'        => 'user@gmail.com',
            'nomor_hp'     => '081234567891',
            'password'     => \Illuminate\Support\Facades\Hash::make('user123'),
        ]);

        \App\Models\User::factory(5)->create();
    }
}

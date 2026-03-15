<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $kategoris = ['Elektronik', 'Pakaian', 'Makanan & Minuman', 'Peralatan Rumah', 'Olahraga'];

        foreach ($kategoris as $nama) {
            \App\Models\Kategori::create(['nama_kategori' => $nama]);
        }
    }
}

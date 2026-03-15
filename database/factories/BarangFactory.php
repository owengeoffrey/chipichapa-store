<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kategori_id'   => \App\Models\Kategori::inRandomOrder()->first()?->id ?? \App\Models\Kategori::factory(),
            'nama_barang'   => fake('id_ID')->words(3, true),
            'harga_barang'  => fake()->numberBetween(5000, 5000000),
            'jumlah_barang' => fake()->numberBetween(0, 100),
            'foto_barang'   => null,
        ];
    }
}

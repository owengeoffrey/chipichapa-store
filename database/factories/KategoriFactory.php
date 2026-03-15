<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kategori>
 */
class KategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $kategori = ['Elektronik', 'Pakaian', 'Makanan & Minuman', 'Peralatan Rumah', 'Olahraga', 'Buku', 'Kecantikan', 'Otomotif'];
        return [
            'nama_kategori' => fake()->unique()->randomElement($kategori),
        ];
    }
}

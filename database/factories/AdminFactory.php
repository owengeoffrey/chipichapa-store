<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake('id_ID')->name();
        return [
            'nama_lengkap' => $name,
            'admin_id'     => 'ADMIN-' . fake()->unique()->numerify('###'),
            'email'        => fake()->unique()->userName() . '@gmail.com',
            'nomor_hp'     => '08' . fake()->numerify('#########'),
            'password'     => \Illuminate\Support\Facades\Hash::make('password'),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BukuFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(3),
            'penulis' => $this->faker->name,
            'tahun_terbit' => $this->faker->numberBetween(2000, date('Y')),
            'penerbit' => $this->faker->company
        ];
    }
}
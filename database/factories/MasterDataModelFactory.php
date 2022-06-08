<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MasterDataModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'harga' => $this->faker->randomNumber(5, true),
            'jenis' => $this->faker->randomElement(['makanan', 'minuman'])
        ];
    }
}

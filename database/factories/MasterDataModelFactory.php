<?php

namespace Database\Factories;

use Illuminate\Http\File;
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
        // $image = $this->faker->image(storage_path('images'),400,300);
        // $imageFile = new File($image);
        // dd(storage_path('images'));
        // Storage::disk('public')->putFile('images', $imageFile),
        // $faker->image((storage_path('images'), 360, 360, 'animals', true, true, 'cats', true, 'jpg');
        
        return [
            'nama' => $this->faker->name(),
            'harga' => $this->faker->randomNumber(5, true),
            'jenis' => $this->faker->randomElement(['makanan', 'minuman']),
            'imageUrl' => $this->faker->image(storage_path('images'), 360, 360, 'animals', true, true, 'cats', true, 'jpg'),
        ];
    }
}

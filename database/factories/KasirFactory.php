<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\masterDataModel;

class KasirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $masterDataModel = masterDataModel::getId();
        $i = 0;
        $masterData=[];
        foreach($masterDataModel as $value){
            $masterData[$i] = $value->id;
            $i++;
        }

        // '000100110122014'

        return [
            'idTransaksi' => ''.$this->faker->randomNumber(4, true).$this->faker->randomNumber(3, true).$this->faker->date('dmY'),
            'masterData' => $this->faker->randomElement($masterData),
            'atasNama' => $this->faker->name(),
            'nomorMeja' => $this->faker->randomNumber(1, true),
            'jumlah' => $this->faker->randomNumber(2, true),
            'status' => $this->faker->randomElement([0,1]),
        ];
    }
}

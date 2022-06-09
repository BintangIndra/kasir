<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterDataModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\masterDataModel::factory(20)->create();
    }
}

<?php

use Illuminate\Database\Seeder;
use App\House;

class HotWaterBlanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 150;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('hot_water_blanks')->insert([
                'house_id' => House::all()->random(1)->id,
                'norm' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
                'total_volume_of_MKD' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
                'tariff_with_NDS' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
                'volume_of_services' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
                'charged' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
                'recalculation' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
                'total_charged' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
                'date' => $faker->date()
            ]);
        }
    }
}










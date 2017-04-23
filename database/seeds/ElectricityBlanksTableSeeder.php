<?php

use Illuminate\Database\Seeder;
use App\House;

class ElectricityBlanksTableSeeder extends Seeder
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
            DB::table('electricity_blanks')->insert([
                'house_id' => House::all()->random(1)->id,
                'tariff_single' => $faker->randomFloat($nbMaxDecimals = 2, $min = 2, $max = 5),
                'tariff_day' => $faker->randomFloat($nbMaxDecimals = 3, $min = 2, $max = 5),
                'tariff_night' => $faker->randomFloat($nbMaxDecimals = 3, $min = 1, $max = 4),
                'consumption' => $faker->randomFloat($nbMaxDecimals = 3, $min = 100, $max = 800),
                'sum_day' => $faker->randomFloat($nbMaxDecimals = 3, $min = 300, $max = 3000),
                'sum_night' => $faker->randomFloat($nbMaxDecimals = 3, $min = 200, $max = 2000),
                'charged' => $faker->randomFloat($nbMaxDecimals = 3, $min = 500, $max = 5000),
                'recalculation' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 5000),
                'total_charged' => $faker->randomFloat($nbMaxDecimals = 3, $min = 500, $max = 5000),
                'date' => $faker->date()
            ]);
        }
    }
}










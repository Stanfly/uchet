<?php

use Illuminate\Database\Seeder;
use App\House;
use App\Service;

class BlanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 1500;


        for ($i = 0; $i < $limit; $i++) {
            DB::table('blanks')->insert([
                'house_id' => House::all()->random(1)->id,
                'service_id' => Service::all()->random(1)->id,
                'tariff' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
                'volume' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
                'date' => $faker->date()
            ]);
        }
    }
}

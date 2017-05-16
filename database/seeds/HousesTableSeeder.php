<?php

use Illuminate\Database\Seeder;

use App\User;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 5;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('houses')->insert([ //,
                'user_id' => User::all()->random(1)->id,
                'name' => $faker->name,
                'area' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100) ,
                'residents' => $faker->randomNumber($nbDigits = 1, $strict = false) ,
            ]);
        }
    }
}

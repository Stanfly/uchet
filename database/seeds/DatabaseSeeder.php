<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(HousesTableSeeder::class);
        $this->call(ColdWaterBlanksTableSeeder::class);
        $this->call(HotWaterBlanksTableSeeder::class);
        $this->call(ElectricityBlanksTableSeeder::class);
    }
}

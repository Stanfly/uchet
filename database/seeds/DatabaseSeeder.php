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
        $this->call(ServicesTableSeeder::class);
        $this->call(BlanksTableSeeder::class);
    }
}

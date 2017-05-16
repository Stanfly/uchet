<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            $email = $faker->email;
            $password = $faker->password();
            echo $email .PHP_EOL;
            echo $password .PHP_EOL.PHP_EOL;

            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $email,
                'password' => bcrypt($password),
            ]);
        }
    }
}

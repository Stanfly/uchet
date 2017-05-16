<?php

use Illuminate\Database\Seeder;
use \App\House;
class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 50;

        $icon_names = ['opacity', 'lightbulb_outline', 'account_balance', 'build', 'delete', 'whatshot', 'tv', 'settings_input_antenna', 'local_florist', 'local_phone'];
        $icon_classes = ['pink accent-3', 'blue', 'yellow', 'green', 'red', 'orange'];

        DB::table('services')->insert([ //,
            'house_id' => null,
            'name' => 'Холодная вода',
            'icon_name' => 'opacity',
            'icon_class' => 'blue'
        ]);

        DB::table('services')->insert([ //,
            'house_id' => null,
            'name' => 'Горячая вода',
            'icon_name' => 'opacity',
            'icon_class' => 'pink accent-3'
        ]);

        DB::table('services')->insert([ //,
            'house_id' => null,
            'name' => 'Электроэнэргия',
            'icon_name' => 'lightbulb_outline',
            'icon_class' => 'yellow'
        ]);


        for ($i = 0; $i < $limit; $i++) {
            DB::table('services')->insert([ //,
                'house_id' => House::all()->random(1)->id,
                'name' => $faker->name,
                'icon_name' => $icon_names[array_rand($icon_names)],
                'icon_class' => $icon_classes[array_rand($icon_classes)],
            ]);
        }
    }
}

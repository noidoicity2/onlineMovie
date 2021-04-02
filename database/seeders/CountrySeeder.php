<?php

namespace Database\Seeders;

use App\Models\Country;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker  = Factory::create();

    for($i = 0 ; $i< 200 ; $i++) {
//        $name = $faker->unique()->country;
        Country::create([
            'name'  => $faker->unique()->country ,
            'description'   => $faker->realText(200 , 2),
            'country_order' => 0,
//            'slug' => Str::slug($name),

        ]);

    }
//        Country::create([
//            'name'  => $faker->unique()->country,
//            'description'   => $faker->realText(200 , 2),
//            'country_order' => 0
//
//        ]);


    }
}

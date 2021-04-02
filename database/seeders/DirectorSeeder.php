<?php

namespace Database\Seeders;

//use App\Models\Country;
use App\Models\Director;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();

        for ($i = 0; $i < 200; $i++) {
//        $name = $faker->unique()->country;
            Director::create([
                'name' => $faker->unique()->name,
                'description' => $faker->realText(200, 2),

//            'slug' => Str::slug($name),

            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Director;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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

        for ($i = 0; $i < 20; $i++) {
//        $name = $faker->uni2que()->country;
            Category::create([
                'name' => $faker->name,
                'description' => $faker->realText(99, 2),

//            'slug' => Str::slug($name),

            ]);
        }
    }
}

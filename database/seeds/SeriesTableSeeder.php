<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1 ,40) as $index)
        {
            $title = $faker->sentence;

            App\Series::create([    
                'title' => $title,
                'slug' => str_slug($title),
                'synopsis' => $faker->paragraphs(3, true),
            ]);
        }
    }
}

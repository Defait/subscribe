<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 100) as $index)
        {
            $users = App\User::all()->pluck('id')->toArray();
            $series = App\Series::all()->pluck('id')->toArray();

            App\Subscription::create([
                'user_id' => $faker->randomElement($users),
                'series_id' => $faker->randomElement($series),
            ]);
        }
    }
}

<?php

use Faker\Factory as Faker;
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
        $faker = Faker::create();

        foreach(range(1, 10) as $index)
        {
            App\User::create([
                'name' => $faker->unique()->name,
                'email' => $faker->unique()->email,
                'password' => 'koekje123',
            ]);
        }
    }
}

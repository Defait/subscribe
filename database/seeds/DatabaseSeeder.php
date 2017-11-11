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
        $tables = [
            'subscriptions',
            'series',
            'users',
        ];

        foreach($tables as $table)
        {
            DB::table($table)->delete();
        }

        $this->call(UsersTableSeeder::class);
        $this->call(SeriesTableSeeder::class);
        $this->call(SubscriptionsTableSeeder::class);
    }
    }
}

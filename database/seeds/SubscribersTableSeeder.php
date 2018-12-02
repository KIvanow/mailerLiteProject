<?php

use Illuminate\Database\Seeder;
use App\Subscribers;

class SubscribersTableSeeder extends Seeder {
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table('subscribers')->delete();

        for ($i = 0; $i < 50; $i++) {
            Subscribers::create([
                'email' => $faker->email,
                'name' => $faker->name,
                'user_id' => $faker->numberBetween(1,2)
            ]);
        }
    }
}

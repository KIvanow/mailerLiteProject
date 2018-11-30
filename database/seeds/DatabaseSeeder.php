<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('SubscribersTableSeeder');
        $this->command->info('Subscribers table seeded!');

        $this->call('FieldsTableSeeder');
        $this->command->info('Fields table seeded!');
    }
}

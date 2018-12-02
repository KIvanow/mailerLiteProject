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
        $this->call(RoleTableSeeder::class);
        $this->command->info('Role table seeded!');
        $this->call(UserTableSeeder::class);
        $this->command->info('User table seeded!');

        $this->call('SubscribersTableSeeder');
        $this->command->info('Subscribers table seeded!');

        $this->call('FieldsTableSeeder');
        $this->command->info('Fields table seeded!');
    }
}

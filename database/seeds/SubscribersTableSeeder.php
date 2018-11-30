<?php

use Illuminate\Database\Seeder;
use App\Subscribers;

class SubscribersTableSeeder extends Seeder {
    private $subscribersSeeds = [
        [
            'email' => 'testUser@quatinus.info',
            "name" => "TestUser"
        ],
        [
            'email' => 'testUser@gmail.com',
            "name" => "TestUser2"
        ]
    ];

    public function run()
    {
        DB::table('subscribers')->delete();
        foreach( $this->subscribersSeeds as $seed ){
            Subscribers::create( $seed );
        }
    }
}

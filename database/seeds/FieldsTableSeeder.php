<?php

use Illuminate\Database\Seeder;
use App\Fields;

class FieldsTableSeeder extends Seeder
{
    private $fieldsSeeds = [
        [
            "title" => "sample type string",
            "type" => "string",
            "subscriber_id" => 1
        ],

        [
            "title" => false,
            "type" => "boolean",
            "subscriber_id" => 1
        ],

        [
            "title" => 13,
            "type" => "number",
            "subscriber_id" => 2
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fields')->delete();
        foreach( $this->fieldsSeeds as $seed ){
            Fields::create( $seed );
        }
    }
}

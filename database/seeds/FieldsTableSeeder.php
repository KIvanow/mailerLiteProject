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
        $faker = \Faker\Factory::create();
        DB::table('fields')->delete();

        $types =[
            "date",
            "number",
            "string",
            "boolean"
        ];

        for ($i = 0; $i < 50; $i++) {
            $typeIndex = $faker->numberBetween( 0, 3 );

            switch ($typeIndex) {
                case 0:
                    $title = $faker->dateTimeThisCentury->format('Y-m-d');
                    break;
                case 1:
                    $title = $faker->randomNumber();
                    break;
                case 2:
                    $title = $faker->sentence();
                    break;
                case 3:
                    $title = $faker->boolean($chanceOfGettingTrue = 50);
                    break;
            }

            $subscriberId = $faker->numberBetween( 1, 50 );

            Fields::create([
                "type" => $types[ $typeIndex ],
                "title" => $title,
                "subscriber_id" => $subscriberId
            ]);
        }
    }
}

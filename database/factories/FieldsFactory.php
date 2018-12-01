<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Fields::class, function (Faker $faker, $data) {
    $subscriber_id = $data["subscriber_id"];

    $typeIndex = $faker->numberBetween( 0, 3 );
    $types =[
        "date",
        "number",
        "string",
        "boolean"
    ];

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

    return [
        'type' => $types[ $typeIndex ],
        'title' => $title,
        "subscriber_id" => $subscriber_id
    ];
});

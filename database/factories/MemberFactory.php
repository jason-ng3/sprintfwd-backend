<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Member;
use App\Models\Team;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'country' => $faker->country,
        'team_id' => function() {
            return factory(Team::class)->create()->id;
        },
    ];
});

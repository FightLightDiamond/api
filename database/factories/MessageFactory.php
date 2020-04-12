<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\IO\Models\Message::class, function (Faker $faker) {

    do {
        $from = rand(1, 5);
        $to = rand(1, 5);
    } while ($from === $to);

    return [
        'from' => $from,
        'to' => $to,
        'content' => $faker->sentence
    ];
});

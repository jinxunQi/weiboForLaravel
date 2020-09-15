<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Status;
use Faker\Generator as Faker;

$factory->define(Status::class, function (Faker $faker) {
//    $faker = \Faker\Factory::create('zh_CN');
    $date_time = $faker->date . ' ' . $faker->time;
    return [
        'content' => $faker->paragraph,
        'created_at' => $date_time,
        'updated_at' => $date_time
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(app\Post::class, function (Faker\Generator $faker) {
    return [
        
        // チートシートを利用する。
        'title' => $faker->word,
        'content'=>$faker->text,
        //
    ];
});

<?php

use App\Post;
use App\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Post::class, function (Faker\Generator $faker) {
    static $password;

    return [
    	'user_id' => function() {
			return factory(App\User::class)->create()->id;
    	},
    	'title' => $faker->sentence,
    	'body' => $faker->paragraph,
    	'slug' => function (array $post) {
            return str_slug($post['title']);
        },
        // 'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = date_default_timezone_get()),
        // 'updated_at' => function (array $post) {
        //     return $post['created_at'];
        // },
    ];
});




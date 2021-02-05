<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

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


$factory->define(App\Models\Mails::class, function (Faker $faker) {
    return [
        'id'=>$faker->numberBetween(0,1000),
        'uuid' => $faker->uuid,
        'posted_by_id' => '',
        'from'=>$faker->title,
        'to'=>$faker->title,
        'subject'=>$faker->title,
        'text_content'=>$faker->sentence,
        'html_content'=>$faker->sentence,
        'status'=>'Posted'
    ];
});








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

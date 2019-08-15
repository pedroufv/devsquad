<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $categories = Category::all('id')->pluck('id')->all();

    return [
        'name' => $faker->unique()->name,
        'description' => $faker->text,
        'price' => $faker->randomNumber(2),
        'category_id' => $faker->randomElements($categories),
    ];
});

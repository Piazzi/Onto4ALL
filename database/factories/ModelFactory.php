<?php

use Faker\Generator as Faker;

$faker = new Faker();

$factory->define(\App\TipClass::class, function (Faker $faker) {
    return [
        "name" => $faker->randomElement(['is a','part of','has part','contains','realizes','realized in','contained in','involved in','located in','member of']),
        "superclass" => $faker->lastName,
        "subclass" => $faker->firstName,
        "definition" => $faker->word,
        "synonyms" => $faker->domainWord,
        "example_of_usage" => $faker->name,
        "imported_from" => $faker->url,
        "formal_definition" => $faker->word
    ];
});

$factory->define(\App\TipsRelation::class, function (Faker $faker) {
    return [
        "name" => $faker->randomElement(['is a','part of','has part','contains','realizes','realized in','contained in','involved in','located in','member of']),
        "domain" => $faker->domainWord,
        "range" => $faker->domainName,
        "definition" => $faker->word,
        "cardinality" => $faker->boolean,
        "similar_relation" => $faker->domainWord,
        "example_of_usage" => $faker->name,
        "imported_from" => $faker->url,
        "formal_definition" => $faker->word
    ];
});
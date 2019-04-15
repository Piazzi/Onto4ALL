<?php

use Faker\Generator as Faker;

$faker = new Faker();

$factory->define(\App\OntologyClass::class, function (Faker $faker) {
    return [
        "name" => $faker->randomElement(['Process', 'Object', 'Blood Cell','Plasma', 'Centrifugation']),
        "superclass" => $faker->lastName,
        "subclass" => $faker->firstName,
        "definition" => $faker->word,
        "synonyms" => $faker->domainWord,
        "example_of_usage" => $faker->name,
        "imported_from" => $faker->url,
        "formal_definition" => $faker->word
    ];
});

$factory->define(\App\OntologyRelation::class, function (Faker $faker) {
    return [
        "name" => $faker->randomElement(['is_a','part_of','has_part','contains','realizes','realized_in','contained_in','involved_in','located_in','member_of']),
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
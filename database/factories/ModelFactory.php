<?php

use Faker\Generator as Faker;

$faker = new Faker();

$factory->define(\App\OntologyClass::class, function (Faker $faker) {
    return [
        "name" => $faker->randomElement(['Process', 'Object', 'Blood Cell','Plasma', 'Centrifugation']),
        "subclass" => $faker->firstName,
        "definition" => $faker->word,
        "synonyms" => $faker->domainWord,
        "example_of_usage" => $faker->name,
        "imported_from" => $faker->url,
        "formal_definition" => $faker->word,
        "class_id" => $faker->safeHexColor,
        "label" => $faker->firstName,
        'is_defined_by'  => $faker->lastName,
        'comments'  => $faker->lastName,
        'disjoint_with' => $faker->lastName,
        'elucidation' => $faker->lastName,
        'ontology' => $faker->randomElement(['bfo','iao','iof'])
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
        "formal_definition" => $faker->word,
        "relation_id" => $faker->safeHexColor,
        "label" => $faker->firstName,
        'synonyms' => $faker->lastName,
        'is_defined_by'  => $faker->lastName,
        'comments'  => $faker->lastName,
        'inverse_of'  => $faker->lastName,
        'subproperty_of'  => $faker->lastName,
        'superproperty_of'  => $faker->lastName,
        'ontology' => $faker->randomElement(['bfo','iao','iof'])

    ];
});

$factory->define(\App\Message::class, function (Faker $faker) {
    return [
        "category" => $faker->randomElement(['other','suggestion','question','bug']),
        "name" => $faker->name,
        "email" => $faker->email,
        "message" => $faker->text,
        "read" => 0
    ];
});
<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\OntologyRelation;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OntologyRelationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OntologyRelation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create('pt_BR');
        return [
            "name" => $faker->randomElement(['is_a', 'part_of', 'has_part', 'contains', 'realizes', 'realized_in', 'contained_in', 'involved_in', 'located_in', 'member_of']),
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
            'ontology' => $faker->randomElement(['bfo', 'iao', 'iof'])
        ];
    }
}

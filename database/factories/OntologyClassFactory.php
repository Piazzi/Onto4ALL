<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\OntologyClass;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OntologyClassFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OntologyClass::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create('pt_BR');
        return [
            "name" => $faker->randomElement(['Process', 'Object', 'Blood Cell', 'Plasma', 'Centrifugation']),
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
            'ontology' => $faker->randomElement(['bfo', 'iao', 'iof'])
        ];
    }
}

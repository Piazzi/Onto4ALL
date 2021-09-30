<?php

namespace Database\Factories;

use App\Models\Model;
use Faker\Factory as Faker;
use GuzzleHttp\Psr7\Message;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create('pt_BR');
        return [
            "category" => $faker->randomElement(['other', 'suggestion', 'question', 'bug']),
            "name" => $faker->name,
            "email" => $faker->email,
            "message" => $faker->text,
            "read" => 0
        ];
    }
}

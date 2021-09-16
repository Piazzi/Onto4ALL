<?php

namespace Tests\Feature;

use App\Thesauru;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ThesaurusTest extends TestCase
{
    public function test_can_see_thesaurus_pt()
    {
        $user = User::inRandomOrder()->first();
        if ($user == null)
            $user = factory(User::class)->create([
                'password' => bcrypt($password = 'teste'),
                'categorie' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/thesaurus');
        $response->assertStatus(200);
    }

    public function test_can_see_thesaurus_en()
    {
        $user = User::inRandomOrder()->first();
        if ($user == null)
            $user = factory(User::class)->create([
                'password' => bcrypt($password = 'teste'),
                'categorie' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/thesaurus');
        $response->assertStatus(200);
    }

    public function test_can_see_thesaurus_form_pt()
    {
        $faker = \Faker\Factory::create();
        $user = User::inRandomOrder()->first();
        if ($user == null)
            $user = factory(User::class)->create([
                'password' => bcrypt($password = 'teste'),
                'categorie' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $thesauru = Thesauru::inRandomOrder()->first();
        if ($thesauru == null) {
            $thesauru = new Thesauru();
            $thesauru->name = $faker->word;
            $thesauru->file = $faker->word;
            $thesauru->user_id = $user->id;
            $thesauru->created_by = $user->name;
            $thesauru->save();
        }

        $response = $this->get('pt/thesaurus/' . $thesauru->id);
        $response->assertStatus(200);
    }

    public function test_can_see_thesaurus_form_en()
    {
        $faker = \Faker\Factory::create();
        $user = User::inRandomOrder()->first();
        if ($user == null)
            $user = factory(User::class)->create([
                'password' => bcrypt($password = 'teste'),
                'categorie' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $thesauru = Thesauru::inRandomOrder()->first();
        if ($thesauru == null) {
            $thesauru = new Thesauru();
            $thesauru->name = $faker->word;
            $thesauru->file = $faker->word;
            $thesauru->user_id = $user->id;
            $thesauru->created_by = $user->name;
            $thesauru->save();
        }

        $response = $this->get('en/thesaurus/' . $thesauru->id);
        $response->assertStatus(200);
    }

    public function test_can_see_thesaurus_form_edit_pt()
    {
        $faker = \Faker\Factory::create();
        $user = User::inRandomOrder()->first();
        if ($user == null)
            $user = factory(User::class)->create([
                'password' => bcrypt($password = 'teste'),
                'categorie' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $thesauru = Thesauru::inRandomOrder()->first();
        if ($thesauru == null) {
            $thesauru = new Thesauru();
            $thesauru->name = $faker->word;
            $thesauru->file = $faker->word;
            $thesauru->user_id = $user->id;
            $thesauru->created_by = $user->name;
            $thesauru->save();
        }
        $response = $this->get('pt/thesaurus/' . $thesauru->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_can_see_thesaurus_form_edit_en()
    {
        $faker = \Faker\Factory::create();
        $user = User::inRandomOrder()->first();
        if ($user == null)
            $user = factory(User::class)->create([
                'password' => bcrypt($password = 'teste'),
                'categorie' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $thesauru = Thesauru::inRandomOrder()->first();
        if ($thesauru == null) {
            $thesauru = new Thesauru();
            $thesauru->name = $faker->word;
            $thesauru->file = $faker->word;
            $thesauru->user_id = $user->id;
            $thesauru->created_by = $user->name;
            $thesauru->save();
        }

        $response = $this->get('en/thesaurus/' . $thesauru->id . '/edit');
        $response->assertStatus(200);
    }
}


<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_user_can_view_a_login_pt_form()
    {
        $response = $this->get('/pt/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_user_can_view_a_login_en_form()
    {
        $response = $this->get('/en/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_user_cannot_view_a_login_pt_form_when_authenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/pt/login');

        $response->assertRedirect('/pt/home');
    }

    public function test_user_cannot_view_a_login_en_form_when_authenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/en/login');

        $response->assertRedirect('/en/home');
    }

    public function test_user_can_login_pt_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'teste'),
        ]);

        $response = $this->post('/pt/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/pt/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_login_en_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'teste'),
        ]);

        $response = $this->post('/en/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/en/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_pt_cannot_login_with_incorrect_password()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('teste'),
        ]);
        
        $response = $this->from('/pt/login')->post('/pt/login', [
            'email' => $user->email,
            'password' => 'erro',
        ]);
        
        $response->assertRedirect('/pt/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_user_en_cannot_login_with_incorrect_password()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('teste'),
        ]);
        
        $response = $this->from('/en/login')->post('/en/login', [
            'email' => $user->email,
            'password' => 'erro',
        ]);
        
        $response->assertRedirect('/en/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_remember_me_functionality_pt()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'teste'),
        ]);
        
        $response = $this->post('/pt/login', [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);
        
        $response->assertRedirect('/pt/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_remember_me_functionality_en()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'teste'),
        ]);
        
        $response = $this->post('/en/login', [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);
        
        $response->assertRedirect('/en/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_view_a_register_pt_form()
    {
        $response = $this->get('/pt/register');

        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    public function test_user_can_view_a_register_en_form()
    {
        $response = $this->get('/en/register');

        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    public function test_user_can_register_pt()
    {
        $faker = \Faker\Factory::create();
        $response = $this->post('/pt/register', [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt($password = 'teste'),
            'remember_token' => str_random(10),
        ]);

        $response->assertRedirect('/');
    }

    public function test_user_can_register_en()
    {
        $faker = \Faker\Factory::create();
        $response = $this->post('/en/register', [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt($password = 'teste'),
            'remember_token' => str_random(10),
        ]);

        $response->assertRedirect('/');
    }
}

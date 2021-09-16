<?php

namespace Tests\Feature;

use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TaxonomiaTest extends TestCase
{

    public function test_user_can_view_index()
    {
        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = factory(User::class)->create([
                'password' => bcrypt($password = 'teste'),
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/user');
        $response->assertStatus(200);

        $response = $this->get('/pt/home');
        $response->assertStatus(200);
    }
}

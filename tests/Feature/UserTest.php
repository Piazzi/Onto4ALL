<?php

namespace Tests\Feature;

use App\Models\OntologyClass;
use App\Models\OntologyRelation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function test_user_can_view_profile_pt()
    {
        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/user');

        $response->assertStatus(200);
    }

    public function test_user_can_view_profile_en()
    {
        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/user');

        $response->assertStatus(200);
    }

    public function test_user_can_view_form_edit_profile_pt()
    {
        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/user/' . $user->id . '/edit');

        $response->assertStatus(200);
    }

    public function test_user_can_view_form_edit_profile_en()
    {
        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/user/1/edit');

        $response->assertStatus(200);
    }

    public function test_user_can_edit_profile_pt()
    {
        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->put('pt/user/' . $user->id, [
            'name' => $user->name,
            'email' => $user->email,
        ]);

        $response->assertStatus(302);
    }

    public function test_user_can_edit_profile_en()
    {
        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->put('en/user/' . $user->id, [
            'name' => $user->name,
            'email' => $user->email,
        ]);

        $response->assertStatus(302);
    }

    public function test_user_can_change_password_pt()
    {
        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->put('pt/update_password/' . $user->id, [
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ]);

        $response->assertStatus(302);
    }

    public function test_user_can_change_password_en()
    {
        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->put('en/update_password/' . $user->id, [
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ]);

        $response->assertStatus(302);
    }

    public function test_only_administrator_can_see_ontology_relation_pt()
    {
        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/ontology_relation/search');
        $response->assertStatus(200);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/ontology_relation/search');
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_see_ontology_relation_en()
    {
        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/ontology_relation/search');
        $response->assertStatus(200);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/ontology_relation/search');
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_see_ontology_relation_form_pt()
    {
        $ontology = OntologyRelation::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/ontology_relation/' . $ontology->id);
        $response->assertStatus(200);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/ontology_relation/' . $ontology->id);
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_see_ontology_relation_form_en()
    {
        $ontology = OntologyRelation::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/ontology_relation/' . $ontology->id);
        $response->assertStatus(200);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/ontology_relation/' . $ontology->id);
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_see_ontology_relation_form_edit_pt()
    {
        $ontology = OntologyRelation::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/ontology_relation/' . $ontology->id . '/edit');
        $response->assertStatus(200);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/ontology_relation/' . $ontology->id . '/edit');
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_see_ontology_relation_form_edit_en()
    {
        $ontology = OntologyRelation::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/ontology_relation/' . $ontology->id . '/edit');
        $response->assertStatus(200);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/ontology_relation/' . $ontology->id . '/edit');
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_delete_relation_pt()
    {
        $ontology = OntologyRelation::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->delete('pt/ontology_relation/' . $ontology->id);
        $response->assertStatus(302);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->delete('pt/ontology_relation/' . $ontology->id);
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_update_relation_pt()
    {
        $ontology = OntologyRelation::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->put('pt/ontology_relation/' . $ontology->id, [$ontology->all()]);
        $response->assertStatus(302);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->put('pt/ontology_relation/' . $ontology->id, [$ontology->all()]);
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_store_relation_pt()
    {
        $ontology = OntologyRelation::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->post('pt/ontology_relation', [$ontology->all()]);
        $response->assertStatus(302);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->post('pt/ontology_relation/', [$ontology->all()]);
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_store_relation_en()
    {
        $ontology = OntologyRelation::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->post('en/ontology_relation', [$ontology->all()]);
        $response->assertStatus(302);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->post('en/ontology_relation/', [$ontology->all()]);
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_update_relation_en()
    {
        $ontology = OntologyRelation::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->put('en/ontology_relation/' . $ontology->id, [$ontology->all()]);
        $response->assertStatus(302);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->put('en/ontology_relation/' . $ontology->id, [$ontology->all()]);
        $response->assertStatus(403);
    }



    public function test_only_administrator_can_see_ontology_class_pt()
    {
        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/ontology_class/search');
        $response->assertStatus(200);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/ontology_class/search');
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_see_ontology_class_en()
    {
        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/ontology_class/search');
        $response->assertStatus(200);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/ontology_class/search');
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_see_ontology_class_form_pt()
    {
        $ontology = OntologyClass::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/ontology_class/' . $ontology->id);
        $response->assertStatus(200);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/ontology_class/' . $ontology->id);
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_see_ontology_class_form_en()
    {
        $ontology = OntologyClass::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/ontology_class/' . $ontology->id);
        $response->assertStatus(200);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/ontology_class/' . $ontology->id);
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_see_ontology_class_form_edit_pt()
    {
        $ontology = OntologyClass::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/ontology_class/' . $ontology->id . '/edit');
        $response->assertStatus(200);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('pt/ontology_class/' . $ontology->id . '/edit');
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_see_ontology_class_form_edit_en()
    {
        $ontology = OntologyClass::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/ontology_class/' . $ontology->id . '/edit');
        $response->assertStatus(200);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->get('en/ontology_class/' . $ontology->id . '/edit');
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_delete_ontology_class_pt()
    {
        $ontology = OntologyClass::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->delete('pt/ontology_class/' . $ontology->id);
        $response->assertStatus(302);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->delete('pt/ontology_class/' . $ontology->id);
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_update_ontology_class_pt()
    {
        $ontology = OntologyClass::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->put('pt/ontology_class/' . $ontology->id, [$ontology->all()]);
        $response->assertStatus(302);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->put('pt/ontology_class/' . $ontology->id, [$ontology->all()]);
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_store_ontology_class_pt()
    {
        $ontology = OntologyClass::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->post('pt/ontology_class', [$ontology->all()]);
        $response->assertStatus(302);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->post('pt/ontology_class/', [$ontology->all()]);
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_store_ontology_class_en()
    {
        $ontology = OntologyClass::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->post('en/ontology_class', [$ontology->all()]);
        $response->assertStatus(302);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->post('en/ontology_class/', [$ontology->all()]);
        $response->assertStatus(403);
    }

    public function test_only_administrator_can_update_ontology_class_en()
    {
        $ontology = OntologyClass::inRandomOrder()->first();
        if ($ontology == null)
            $ontology = OntologyRelation::factory()->create();

        $user = User::where('categoria', 'administrador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'administrador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->put('en/ontology_class/' . $ontology->id, [$ontology->all()]);
        $response->assertStatus(302);

        $user = User::where('categoria', 'modelador')->first();
        if ($user == null)
            $user = User::factory()->create([
                'password' => bcrypt($password = 'teste'),
                'categoria' => 'modelador',
            ]);
        Auth::loginUsingId($user->id);

        $response = $this->put('en/ontology_class/' . $ontology->id, [$ontology->all()]);
        $response->assertStatus(403);
    }
}

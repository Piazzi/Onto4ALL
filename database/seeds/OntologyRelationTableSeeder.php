<?php

use App\Models\OntologyRelation;
use Illuminate\Database\Seeder;

class OntologyRelationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OntologyRelation::factory()->count(50)->create();
    }
}

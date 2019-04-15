<?php

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
        factory(App\OntologyRelation::class, 50)->create()->each(function ($user) {

        });
    }
}

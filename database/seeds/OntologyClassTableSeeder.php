<?php

use App\Models\OntologyClass;
use Illuminate\Database\Seeder;

class OntologyClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OntologyClass::factory()->count(50)->create();
    }
}

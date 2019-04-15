<?php

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
        factory(App\OntologyClass::class, 50)->create()->each(function ($user) {

        });
    }
}

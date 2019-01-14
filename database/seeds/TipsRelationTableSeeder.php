<?php

use Illuminate\Database\Seeder;

class TipsRelationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TipsRelation::class, 50)->create()->each(function ($user) {

        });
    }
}

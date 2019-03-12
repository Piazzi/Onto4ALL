<?php

use Illuminate\Database\Seeder;

class TipsClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TipClass::class, 50)->create()->each(function ($user) {

        });
    }
}

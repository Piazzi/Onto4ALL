<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(OntologyClassTableSeeder::class);
        $this->call(OntologyRelationTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
    }
}

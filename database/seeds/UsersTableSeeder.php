<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(5)->create();
        User::updateOrCreate([
            'name' => 'Admin',
            'email' => 'admin@admin.com.br',
        ], [
            'name' => 'Admin',
            'email' => 'admin@admin.com.br',
            'password' => bcrypt('123456'),
        ]);
    }
}

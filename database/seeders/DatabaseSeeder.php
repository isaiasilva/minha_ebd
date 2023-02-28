<?php

namespace Database\Seeders;

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
        $this->call(IgrejaSeeder::class);
        $this->call(PerfilSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(TurmaSeeder::class);
        $this->call(UserSeeder::class);
    }
}

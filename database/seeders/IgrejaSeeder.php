<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IgrejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('igrejas')->insert(
            ['nome' => 'MEPB Goiabeiras']
        );

        DB::table('igrejas')->insert(
            ['nome' => 'MEPB Colônia']
        );

        DB::table('igrejas')->insert(
            ['nome' => 'MEPB Jardim Iracema']
        );
    }
}

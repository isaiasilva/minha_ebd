<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Psy\Util\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Cláudio Oliveira" ,
            'email' => 'claudio@professor',
            'perfil_id' => 3,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => '1994-04-08',
            'turma_id'=> 3,
            'password' => Hash::make('Senha@2021'),
        ]);

        DB::table('users')->insert([
            'name' => "Ronaldo Mendes",
            'email' => 'ronaldo@adm',
            'perfil_id' => 1,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => '1994-04-08',
            'turma_id'=> 3,
            'password' => Hash::make('Adm@1234'),
        ]);

        DB::table('users')->insert([
            'name' => "Jussara Magalhães",
            'email' => 'jussara@adm',
            'perfil_id' => 1,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => '1994-04-08',
            'turma_id'=> 3,
            'password' => Hash::make('Adm@1234'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,1000) . '@gmail.com',
            'perfil_id' => 2,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
            ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,1000) . '@gmail.com',
            'perfil_id' => 2,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,1000) . '@gmail.com',
            'perfil_id' => 2,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,1000) . '@gmail.com',
            'perfil_id' => 2,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,1000) . '@gmail.com',
            'perfil_id' => 2,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,1000) . '@gmail.com',
            'perfil_id' => 2,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,1000) . '@gmail.com',
            'perfil_id' => 2,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,1000) . '@gmail.com',
            'perfil_id' => 2,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,1000) . '@gmail.com',
            'perfil_id' => 2,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,1000) . '@gmail.com',
            'perfil_id' => 2,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,1000) . '@gmail.com',
            'perfil_id' => 2,
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);




    }
}

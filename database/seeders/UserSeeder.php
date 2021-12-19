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
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,99) . '@gmail.com',
            'perfil' => 'ALUNO',
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
            ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,99) . '@gmail.com',
            'perfil' => 'ALUNO',
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,99) . '@gmail.com',
            'perfil' => 'ALUNO',
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,99) . '@gmail.com',
            'perfil' => 'ALUNO',
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,99) . '@gmail.com',
            'perfil' => 'ALUNO',
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,99) . '@gmail.com',
            'perfil' => 'ALUNO',
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,99) . '@gmail.com',
            'perfil' => 'ALUNO',
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,99) . '@gmail.com',
            'perfil' => 'ALUNO',
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,99) . '@gmail.com',
            'perfil' => 'ALUNO',
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,99) . '@gmail.com',
            'perfil' => 'ALUNO',
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => "Fulando de Tal" . rand(1,100),
            'email' => 'name'. rand(1,99) . '@gmail.com',
            'perfil' => 'ALUNO',
            'estado_civil' => 'SOLTEIRO',
            'data_nascimento' => new \DateTime('08/04/1994'),
            'turma_id'=> rand(1,8),
            'password' => Hash::make('password'),
        ]);




    }
}

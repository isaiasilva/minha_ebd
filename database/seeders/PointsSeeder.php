<?php

namespace Database\Seeders;

use App\Models\{Chamada, XP};
use Illuminate\Database\Seeder;

class PointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $atraso       = Chamada::where(['atraso' => true, 'falta_justificada' => false])->get();
        $presencas    = Chamada::where(['atraso' => false, 'falta_justificada' => false])->get();
        $justificadas = Chamada::where(['atraso' => false, 'falta_justificada' => true])->get();

        $atraso->map(function ($item) {

            $xp = XP::where('user_id', $item->aluno_id)->first();

            if ($xp) {
                $xp->points += 7;
                $xp->save();
            }
        });

        $presencas->map(function ($item) {

            $xp = XP::where('user_id', $item->aluno_id)->first();

            if ($xp) {
                $xp->points += 10;
                $xp->save();
            }
        });

        $justificadas->map(function ($item) {

            $xp = XP::where('user_id', $item->aluno_id)->first();

            if ($xp) {
                $xp->points += 2;
                $xp->save();
            }
        });
    }
}

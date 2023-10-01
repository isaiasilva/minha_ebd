<?php

use App\Models\{Igreja, UsuariosPorIgreja};
use Illuminate\Support\Facades\Auth;

function calculateAge(string $birthDate): string
{
    $startDate = new \DateTime($birthDate);
    $endDate   = new \DateTime();
    $interval  = $endDate->diff($startDate);

    return $interval->y . ' anos';
}

function cutName(string $name): string
{
    $name = explode(' ', $name);

    if (array_key_exists(1, $name)) {
        return $name[0] . ' ' . $name[1];
    }

    return $name[0];
}

function getChurch(): Igreja
{
    return UsuariosPorIgreja::where('user_id', Auth::user()->id)->first()->igreja;
}

function alternatives(int $key): string
{
    $alternatives = ["A)", "B)", "C)", "D)", "E)", "F)", "G)", "H)", "I)", "J)", ];

    return $alternatives[$key];
}

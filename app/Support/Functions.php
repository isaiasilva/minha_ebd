<?php

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

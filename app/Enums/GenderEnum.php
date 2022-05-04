<?php
declare(strict_types=1);

namespace App\Enums;

class GenderEnum
{
    const MALE = 'Monsieur';
    const FEMALE = 'femme';

    public static array $genders = [self::MALE, self::FEMALE];
}

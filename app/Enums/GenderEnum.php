<?php
declare(strict_types=1);

namespace App\Enums;

class GenderEnum
{
    const MALE = 'masculin';
    const FEMALE = 'feminin';

    public static array $genders = [self::MALE, self::FEMALE];
}

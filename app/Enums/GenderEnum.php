<?php

declare(strict_types=1);

namespace App\Enums;

final class GenderEnum
{
    public const MALE = 'masculin';

    public const FEMALE = 'feminin';

    public static array $genders = [self::MALE, self::FEMALE];
}

<?php

declare(strict_types=1);

namespace App\Enums;

final class ExpenseType
{
    public const ACADEMIC_SUPPORT = 'Soutien Scolaire';

    public const INSTITUTIONAL = 'Support Institutionnel';

    public const STUDENT = 'Service d\'aide aux étudiants';

    public const TRANSPORTATION = 'Transport';

    public const ELECTRICITY = 'Electricite et eau';

    public static array $geesTypes = [
        self::ACADEMIC_SUPPORT,
        self::INSTITUTIONAL,
        self::STUDENT,
        self::ELECTRICITY,
        self::TRANSPORTATION,
    ];
}

<?php

declare(strict_types=1);

namespace App\Enums;

enum FeeType: string
{
    case TuitionFee = 'Frais de scolarite';

    case ExamFee = 'Frais d\'examen';

    case MonthFee = 'Frais mensuel';

    case OthersFee = 'Autre frais';
}

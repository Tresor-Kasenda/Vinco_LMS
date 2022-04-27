<?php
declare(strict_types=1);

namespace App\Enums;

enum RoleEnum: int
{
    const STUDENT = 1;
    const PROFESSOR = 2;
    const CHEF_COURSES = 3;
    const DEPARTMENT = 4;
    const CAMPUS = 5;
    const ADMIN = 6;
}

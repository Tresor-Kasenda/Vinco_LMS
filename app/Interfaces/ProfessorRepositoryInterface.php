<?php
declare(strict_types=1);

namespace App\Interfaces;

interface ProfessorRepositoryInterface
{
    public function getProfessors();

    public function showProfessor(string $key);

    public function stored($attributes, $factory);

    public function updated(string $key, $attributes, $factory);

    public function deleted(string $key, $factory);

}

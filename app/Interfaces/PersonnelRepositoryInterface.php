<?php
declare(strict_types=1);

namespace App\Interfaces;

interface PersonnelRepositoryInterface
{
    public function getPersonnelContent();

    public function showPersonnelContent(string $key);

    public function stored($attributes);

    public function edited(string $key);

    public function updated(string $key, $attributes);

    public function deleted(string $key);

}

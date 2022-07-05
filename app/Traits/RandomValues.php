<?php

declare(strict_types=1);

namespace App\Traits;

trait RandomValues
{
    public function generateRandomTransaction(int $values, $name): string
    {
        $characters = now()->format('Y').'0123456789ABCDEFGHILKMNOPQRSTUVWXYZabcdefghilkmnopqrstuvwxyz'.$name;
        $randomString = '';
        for ($i = 0; $i < $values; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return strtoupper($randomString);
    }

    public function generateStringValues(int $firstValue, int $secondValue): string
    {
        return strval(rand($firstValue, $secondValue));
    }

    public function randomMatriculate(string $name): string
    {
        $characters = now()->format('Y').substr($name, 0, 3);
        $randomMatriculate = '';
        for ($i = 0; $i < $name; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomMatriculate .= $characters[$index];
        }

        return strtoupper($randomMatriculate);
    }
}

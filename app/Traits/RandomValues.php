<?php
declare(strict_types=1);

namespace App\Traits;

trait RandomValues
{
    public function  generateRandomTransaction(int $values): string
    {
        $characters = now()->format('Y')."0123456789ABCDEFGHILKMNOPQRSTUVWXYZabcdefghilkmnopqrstuvwxyz";
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
}

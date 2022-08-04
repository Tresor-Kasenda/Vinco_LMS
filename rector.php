<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Laravel\Set\LaravelSetList;
use Rector\Symfony\Set\SymfonySetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__.'/app',
        __DIR__.'/tests',
        __DIR__.'/database/seeders',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);
    $rectorConfig->import(Rector\Set\ValueObject\LevelSetList::UP_TO_PHP_81);
    $rectorConfig->import(SymfonySetList::SYMFONY_STRICT);
    $rectorConfig->import(SymfonySetList::SYMFONY_60);
    $rectorConfig->import(SymfonySetList::SYMFONY_CODE_QUALITY);

    $rectorConfig->sets([
        LaravelSetList::LARAVEL_90,
    ]);

    $services = $rectorConfig->services();
    $services->set(Rector\Symfony\Rector\New_\StringToArrayArgumentProcessRector::class);

    $services->set(Rector\Php74\Rector\Property\TypedPropertyRector::class);
    $services->set(Rector\Privatization\Rector\Class_\FinalizeClassesWithoutChildrenRector::class);
};

<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src/Exercise03',
        __DIR__ . '/src/Exercise05',
    ])
    ->withRules([
        \Utils\Rector\Rector\UpdateSayHelloToGreetRector::class,
        \Utils\Rector\Rector\UpdateDogMakeNoiseToBarkRector::class,
        \Utils\Rector\Rector\UpdateEchoMessageRector::class,
        \Utils\Rector\Rector\PostToPreIncrementRector::class,
    ])
;
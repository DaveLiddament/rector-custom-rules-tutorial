<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/scratch',
    ])
    ->withRules([
            \Utils\Rector\Rector\UpdatePostToPreIncrementRector::class,
            \Utils\Rector\Rector\UpdateSayHelloToGreetRector::class,
            \Utils\Rector\Rector\UpdateMessageToILoveRector::class,
            \Utils\Rector\Rector\MakeInArrayStrictRector::class,
        ]
    );
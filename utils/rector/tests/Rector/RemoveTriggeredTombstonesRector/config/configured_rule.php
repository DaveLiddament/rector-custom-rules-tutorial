<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(
        \Utils\Rector\Rector\RemoveTriggeredTombstonesRector::class,
    [
        [
            'Rector\Tests\TypeDeclaration\Rector\RemoveTriggeredTombstonesRector\Fixture\Foo',
            'run',
        ],
        [
            'Rector\Tests\TypeDeclaration\Rector\RemoveTriggeredTombstonesRector\Fixture\Bar',
            'baz',
        ],
    ]);
};

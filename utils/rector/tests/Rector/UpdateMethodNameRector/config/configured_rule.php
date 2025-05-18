<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(
        \Utils\Rector\Rector\UpdateMethodNameRector::class,
        [
            new \Utils\Rector\Config\MethodRename(
            \DaveLiddament\RectorCustomRulesWorkshop\Exercise06\Car::class,
            'getEngine',
            'getEngineSize',
            )
        ]
    );};

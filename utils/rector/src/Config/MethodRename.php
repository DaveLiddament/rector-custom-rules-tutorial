<?php

namespace Utils\Rector\Config;

use Rector\Validation\RectorAssert;

final class MethodRename
{
    /** @param class-string $className */
    public function __construct(
        public readonly string $className,
        public readonly string $oldMethod,
        public readonly string $newMethod,
    ) {
        RectorAssert::className($className);
        RectorAssert::methodName($oldMethod);
        RectorAssert::methodName($newMethod);
    }
}
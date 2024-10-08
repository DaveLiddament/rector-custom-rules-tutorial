<?php

namespace DaveLiddament\RectorCustomRulesWorkshop\Exercise05;

class LookupService
{
    /** @param array<string,mixed> $values */
    public function __construct(private array $values)
    {
    }

    public function lookup(string $key): mixed
    {
        return $this->values[$key] ?? null;
    }
}
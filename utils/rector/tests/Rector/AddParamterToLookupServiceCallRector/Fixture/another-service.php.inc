<?php

namespace Rector\Tests\TypeDeclaration\Rector\AddParamterToLookupServiceCallRector\Fixture;

class PersonLookupService
{
    public function lookup(string $name): mixed
    {
    }
}

function lookup(PersonLookupService $lookupService): mixed
{
    return $lookupService->lookup('name');
}

?>

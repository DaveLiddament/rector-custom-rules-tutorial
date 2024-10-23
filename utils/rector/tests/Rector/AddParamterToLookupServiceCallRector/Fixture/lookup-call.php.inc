<?php

namespace Rector\Tests\TypeDeclaration\Rector\AddParamterToLookupServiceCallRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\LookupService;

function lookup(LookupService $lookupService): mixed
{
    return $lookupService->lookup('name');
}

?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\AddParamterToLookupServiceCallRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\LookupService;

function lookup(LookupService $lookupService): mixed
{
    return $lookupService->lookup('name', null);
}

?>
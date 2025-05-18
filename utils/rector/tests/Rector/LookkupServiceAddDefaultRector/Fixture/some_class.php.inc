<?php

namespace Rector\Tests\TypeDeclaration\Rector\LookkupServiceAddDefaultRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\LookupService;

function takesLookupService(LookupService $lookupService, AnotherService $anotherService): void {
    $lookupService->lookup('foo');
    $lookupService->bar('hello');
    $anotherService->lookup('baz');
    $lookupService->lookup('foo', 'bar');
}

?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\LookkupServiceAddDefaultRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\LookupService;

function takesLookupService(LookupService $lookupService, AnotherService $anotherService): void {
    $lookupService->lookup('foo', null);
    $lookupService->bar('hello');
    $anotherService->lookup('baz');
    $lookupService->lookup('foo', 'bar');
}

?>

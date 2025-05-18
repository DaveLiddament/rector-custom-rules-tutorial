<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateDogMakeNoiseToBarkRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\Dog;

function feed(Dog $dog): void
{
    $dog->feed();
}

?>
<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateDogMakeNoiseToBarkRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\Cat;

function play(Cat $cat): void
{
    $cat->makeNoise();
}

?>
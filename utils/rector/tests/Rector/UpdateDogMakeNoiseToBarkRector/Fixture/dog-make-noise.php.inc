<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateDogMakeNoiseToBarkRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\Dog;

function play(Dog $dog): void
{
    $dog->makeNoise();
}

?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateDogMakeNoiseToBarkRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\Dog;

function play(Dog $dog): void
{
    $dog->bark();
}

?>

<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateMethodNameRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise06\Car;

function getInfo(Car $car):int
{
    return $car->getEngine();
}
?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateMethodNameRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise06\Car;

function getInfo(Car $car):int
{
    return $car->getEngineSize();
}
?>

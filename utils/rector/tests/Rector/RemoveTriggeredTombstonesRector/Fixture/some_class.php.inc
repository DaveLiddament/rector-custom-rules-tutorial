<?php

namespace Rector\Tests\TypeDeclaration\Rector\RemoveTriggeredTombstonesRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise07\Tombstone;

class Foo
{
    public function run(): void
    {
        Tombstone::trigger('Rector\Tests\TypeDeclaration\Rector\RemoveTriggeredTombstonesRector\Fixture\Foo', 'run');
        echo 'run';
    }

    public function stop(): void
    {
        Tombstone::trigger('Rector\Tests\TypeDeclaration\Rector\RemoveTriggeredTombstonesRector\Fixture\Foo', 'stop');
        echo 'run';
    }
}

class Bar
{
    public function baz(): void
    {
        Tombstone::trigger('Rector\Tests\TypeDeclaration\Rector\RemoveTriggeredTombstonesRector\Fixture\Bar', 'baz');
        echo 'baz';
    }
}

?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\RemoveTriggeredTombstonesRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise07\Tombstone;

class Foo
{
    public function run(): void
    {
        echo 'run';
    }

    public function stop(): void
    {
        Tombstone::trigger('Rector\Tests\TypeDeclaration\Rector\RemoveTriggeredTombstonesRector\Fixture\Foo', 'stop');
        echo 'run';
    }
}

class Bar
{
    public function baz(): void
    {
        echo 'baz';
    }
}

?>

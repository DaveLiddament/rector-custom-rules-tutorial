<?php

namespace Rector\Tests\TypeDeclaration\Rector\AddTombstoneRector\Fixture;

class SomeClass
{
    public function foo(): void
    {
        echo "foo";
    }
}

?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\AddTombstoneRector\Fixture;

class SomeClass
{
    public function foo(): void
    {
        \DaveLiddament\RectorCustomRulesWorkshop\Exercise07\Tombstone::trigger('Rector\Tests\TypeDeclaration\Rector\AddTombstoneRector\Fixture\SomeClass', 'foo');
        echo "foo";
    }
}

?>
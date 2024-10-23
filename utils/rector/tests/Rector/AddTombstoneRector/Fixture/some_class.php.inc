<?php

namespace Rector\Tests\TypeDeclaration\Rector\AddTombstoneRector\Fixture;

class SomeClass
{
    public function foo(): void
    {
        echo "foo";
    }

    public function bar(): void
    {
    }
}

class AnotherClass
{
    public function baz(): void
    {
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

    public function bar(): void
    {
        \DaveLiddament\RectorCustomRulesWorkshop\Exercise07\Tombstone::trigger('Rector\Tests\TypeDeclaration\Rector\AddTombstoneRector\Fixture\SomeClass', 'bar');
    }
}

class AnotherClass
{
    public function baz(): void
    {
        \DaveLiddament\RectorCustomRulesWorkshop\Exercise07\Tombstone::trigger('Rector\Tests\TypeDeclaration\Rector\AddTombstoneRector\Fixture\AnotherClass', 'baz');
    }
}

?>

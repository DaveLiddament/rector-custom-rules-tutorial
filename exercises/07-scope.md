# Additional context via scope

## Demo

Sometimes we need extra information about the node based on where it is in the code.

### Tombstone

We want to add a tombstone to every method. 

Before:
```php
class Foo {
    public function bar(): void {
    }
}
```

After:
```php
class Foo {
    public function bar(): void {
        Tombstone::trigger('Foo', 'bar');
    }
}
```

### Test

Basic test case:

```php
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
```


### Rector

We are interested in `ClassMethod` elements. We'll also need to know what class the method is in. 
This information is available from scope. To get the scope use:

```php
         $scope = ScopeFetcher::fetch($node);
```

We can then get information about the node based on where it is in the AST, e.g. to get the class name:

```php
        $className = $scope->getClassReflection()?->getName() ?? null;
        if ($className === null) {
            return null;
        }
```

Then we need to create a statement to add to the method:

```php
        $staticCall = $this->nodeFactory->createStaticCall(
            Tombstone::class,
            'trigger',
            [
                $this->nodeFactory->createArg($className),
                $this->nodeFactory->createArg($node->name->name),
            ]
        );

        $staticCallStatement = new Node\Stmt\Expression($staticCall);
```

Finally update the method's statements, adding this new one to the start:

```php
        $statements = $node->stmts ?? [];
        array_unshift($statements, $staticCallStatement);
        $node->stmts = $statements;

        return $node;
```

# Your turn

## 1. Update the rule above to run multiple times

If you run the rector above twice, it will add multiple calls to `Tombstone::trigger`.
Update the rule to make it possible to rerun the rector multiple time.


## 2. Create a rector to remove triggered tombstones

Assume we run the code in production to get a list of triggered tombstones. 
We need to remove the calls that trigger the tombstones.

Assume test scenario:

```php
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
```

Assume we pass the triggered tombstones via config. The config is in format:
```php
[
    ['class name', 'method name'],
    ['class name', 'method name'],
]
```

In this case the test config will look like this:

```php
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(
        \Utils\Rector\Rector\RemoveTriggeredTombstonesRector::class,
    [
        [
            'Rector\Tests\TypeDeclaration\Rector\RemoveTriggeredTombstonesRector\Fixture\Foo',
            'run',
        ],
        [
            'Rector\Tests\TypeDeclaration\Rector\RemoveTriggeredTombstonesRector\Fixture\Bar',
            'baz',
        ],
    ]);
};
```

Create a rector to do this.

NOTE: There are more test cases needed. 

## Now work through the bonus exercises.

See [08-bonus-exercises](08-bonus-exercises.md)


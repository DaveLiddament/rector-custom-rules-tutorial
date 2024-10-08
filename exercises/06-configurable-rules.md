# Configurable rules

## Demo

It is possible to pass configuration options to a rule. Let's make a generic version of `UpdateDogMakeNoiseToBarkRector`.

To make this generic we need to supply the following:
- class to operate on
- old method name
- new method name

### Rule configuration changes

Rule needs to extend `ConfigurableRectorInterface` and provide implementation for `configure` method.

```php
final class UpdateMethodNameRector extends AbstractRector implements ConfigurableRectorInterface
{

    private array $renameDetails;
    
    public function configure(array $configuration): void
    {
        // Ideally do some validation here
        $this->renameDetails = $configuration;
    }

}
```

Update `getRuleDefinition` to use `ConfiguredCodeSample`, which takes an extra argument.

```php
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Update method name', [
            new ConfiguredCodeSample(
                <<<'CODE_SAMPLE'
$cat->getEngine(),
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
$car->getEngineSize(),
CODE_SAMPLE
            ,
            ['className', 'oldMethodName', 'newMethodName'],
            )
        ]);
    }
```

### Test updates

We'll create a test fixture to update `Car::getEngine` to `Car::getEngineSize`

```php
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
```

Update our test code to include the extra config in `configured_rule.php`:

```php
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(
        \Utils\Rector\Rector\UpdateMethodNameRector::class,
        [
            \DaveLiddament\RectorCustomRulesWorkshop\Exercise06\Car::class,
            'getEngine',
            'getEngineSize',
        ]
    );
};
```

### Implement the rule

```php
    /**
     * @param Node\Expr\MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $this->isName($node->name, $this->renameDetails[1])) {
            return null;
        }

        if (! $this->isObjectType(
            $node->var,
            new ObjectType($this->renameDetails[0])
        )) {
            return null;
        }

        $node->name = new Node\Identifier($this->renameDetails[2]);
        return $node;
    }
```

# Your turn

## 1. Update the config to allow multiple renames and use value objects

Many rector configurable rules use value objects, rather than unstructured array to hold config. 
This reduces the chances of misconfiguration.

We can create a value object to hold the changes we want to make:

```php
final class MethodRename
{
    /** @param class-string $className */
    public function __construct(
        public readonly string $className,
        public readonly string $oldMethod,
        public readonly string $newMethod,
    ) {
        RectorAssert::className($className);
        RectorAssert::methodName($oldMethod);
        RectorAssert::methodName($newMethod);
    }
}
```

Update the `UpdateMethodNameRector` so it is configured with an array of `MethodRename` value objects.
Start with tests first.


## 2. Update the rule so that it also updates the method name

Often we want rules to do multiple things. The rule we have created updates does half the job. 
Update it, so it updates the method name, as well as the calls to that method. 

E.g. Before
```php
class Car {
    public function getEngine(): int 
    {
        // implementation
    }
}
```

After:
```php
class Car {
    public function getEngineSize(): int 
    {
        // implementation
    }
}
```


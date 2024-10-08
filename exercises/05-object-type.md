# We are going to learn about ObjectType using a test first approach

## Demo

Take a look at `src\Dog.php`. Assume we update the method name `makeNoise` to `bark`.
We are going to make a rector that updates any calls to `Dog::makeNoise` to `Dog::bark` (e.g.in `play-with-dog.php`)

This will be done using a test first approach. 

## Tests

### Test 1: Make the update 

File: `dog-make-noise.php.inc`

```php
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
```


### Test 2: Make sure other methods calls on `Dog` are not updated

File: `dog-feed.php.inc`

```php
<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateDogMakeNoiseToBarkRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\Dog;

function feed(Dog $dog): void
{
    $dog->feed();
}

?>
```

### Test 3: Make sure calls to `makeNoise` on non `Dog` objects are not updated:

File `cat.php.inc`

```php
<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateDogMakeNoiseToBarkRector\Fixture;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\Cat;

function play(Cat $cat): void
{
    $cat->makeNoise();
}

?>
```

Run the tests, check we have at least one failure.

## Create the rector

### Create a code sample

### What type of node are we interested in?

We can use this snippet to find the node
```php
$dog->makeNoise();
```

We are interested in a `MethodCall`

### Create the rector step at a time

#### Update method name 

```php
        $node->name = new Identifier('bark');
        return $node;
```

Run the tests.

#### Limit to just `makeNoise` method calls

```php
        if (!$this->isName($node->name, 'makeNoise')) {
            return null;
        }
```

Run the tests

#### Limit to only calls on `Dog` object

We need to know the type we are operating the method call on. Rector provides the `isObjectType` method to help us.

```php
        if (!$this->isObjectType($node->var, new ObjectType(Dog::class))) {
            return null;
        }
```

Rerun the tests. They should all pass.


# Your turn

## Add a parameter to a method call

We are going to add an extra parameter to the `LookupService::lookup` method. 
The new method signature is:

```php
public function lookup(string $key, mixed $default): mixed
```

Update a rector to find all calls to `LookupService::lookup`, add a second parameter which is `null` to the method call.

E.g. 

```php
$lookupService->lookup("foo"); 
```

Becomes:

```php
$lookupService->lookup("foo", null); 
```

First create all the test cases you can think of (hint there are at least 4).
Then build to rule, step at a time. 

TIP: When creating a new node try using the relevant method on `$this->nodeFactory`.


## Complete tasks from previous exercises
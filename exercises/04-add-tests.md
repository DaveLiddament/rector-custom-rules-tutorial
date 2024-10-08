# Testing rector rules

## Demo

Take a look at folder `utils/rector/tests/UpdatedSayToHelloToGreet`

- `UpdateSayHelloToGreetRectorTest`
- `configure/configured_rule.php`
- `Fixture/some_class.php.inc`

Run the tests 

```shell
vendor/bin/phpunit
```

Update test to make it pass:

```php
<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateSayHelloToGreetRector\Fixture;

sayHello("jack and jill");

?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateSayHelloToGreetRector\Fixture;

greet("jack and jill");

?>
```


Aso add a test case for where the code should not change:

```php
<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateSayHelloToGreetRector\Fixture;

anotherFunction("jack and jill");

?>
```


# Your turn

Create the tests for the other rules you made in exercise 3.
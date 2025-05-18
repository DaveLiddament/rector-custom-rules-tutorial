<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateSayHelloToGreetRector\Fixture;

sayHello("jack and jill");

?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateSayHelloToGreetRector\Fixture;

greet("jack and jill");

?>
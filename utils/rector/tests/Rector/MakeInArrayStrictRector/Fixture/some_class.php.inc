<?php

namespace Rector\Tests\TypeDeclaration\Rector\MakeInArrayStrictRector\Fixture;

in_array('foo', []);
in_array('foo', [],false);
aMethod('foo', []);

?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\MakeInArrayStrictRector\Fixture;

in_array('foo', [], true);
in_array('foo', [],true);
aMethod('foo', []);

?>

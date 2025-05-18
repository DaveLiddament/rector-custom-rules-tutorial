<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdatePostToPreIncrementRector\Fixture;

++$foo;
$bar++;

?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdatePostToPreIncrementRector\Fixture;

$foo++;
$bar++;

?>

<?php

namespace Rector\Tests\TypeDeclaration\Rector\PostToPreIncrementRector\Fixture;

$count = 0;
$count++;

?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\PostToPreIncrementRector\Fixture;

$count = 0;
++$count;

?>

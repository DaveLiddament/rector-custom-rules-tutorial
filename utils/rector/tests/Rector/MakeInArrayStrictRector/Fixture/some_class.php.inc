<?php

namespace Rector\Tests\TypeDeclaration\Rector\MakeInArrayStrictRector\Fixture;

in_array(1, [1, 2, 3]);
in_array(2, [1, 2, 3], false);
in_array(3, [1, 2, 3], true);

?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\MakeInArrayStrictRector\Fixture;

in_array(1, [1, 2, 3], true);
in_array(2, [1, 2, 3], true);
in_array(3, [1, 2, 3], true);

?>

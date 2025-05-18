<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateMessageToILoveRector\Fixture;

echo 'I hate rector';
echo 'Another message';

?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateMessageToILoveRector\Fixture;

echo 'I love rector';
echo 'Another message';

?>

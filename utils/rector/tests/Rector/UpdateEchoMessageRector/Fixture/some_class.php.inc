<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateEchoMessageRector\Fixture;

echo 'Hello world!';
echo 'I hate rector';

?>
-----
<?php

namespace Rector\Tests\TypeDeclaration\Rector\UpdateEchoMessageRector\Fixture;

echo 'Hello world!';
echo 'I love rector';

?>

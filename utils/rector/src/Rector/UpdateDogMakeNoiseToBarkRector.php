<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\Dog;
use PhpParser\Node;
use Rector\Rector\AbstractRector;
use PHPStan\Type\ObjectType;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\UpdateDogMakeNoiseToBarkRector\UpdateDogMakeNoiseToBarkRectorTest
 */
final class UpdateDogMakeNoiseToBarkRector extends AbstractRector
{
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Node\Expr\MethodCall::class];
    }

    /**
     * @param \PhpParser\Node\Expr\MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (!$this->isObjectType($node->var, new ObjectType(Dog::class))) {
            return null;
        }

        if (!$this->isName($node->name, 'makeNoise')) {
            return null;
        }

        $node->name = new Node\Name('bark');
        return $node;
    }
}

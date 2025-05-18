<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use PhpParser\Node\Expr\PreInc;
use Rector\Rector\AbstractRector;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\UpdatePostToPreIncrementRector\UpdatePostToPreIncrementRectorTest
 */
final class UpdatePostToPreIncrementRector extends AbstractRector
{
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [PreInc::class];
    }

    /**
     * @param PreInc $node
     */
    public function refactor(Node $node): ?Node
    {
        return new Node\Expr\PostInc($node->var);
    }
}

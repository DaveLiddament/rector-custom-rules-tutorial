<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use Rector\Rector\AbstractRector;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\UpdateMessageToILoveRector\UpdateMessageToILoveRectorTest
 */
final class UpdateMessageToILoveRector extends AbstractRector
{
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Node\Stmt\Echo_::class];
    }

    /**
     * @param Node\Stmt\Echo_::class $node
     */
    public function refactor(Node $node): ?Node
    {
        $item = $node->exprs[0] ?? null;
        if ($item instanceof Node\Scalar\String_) {
            if ($item->value === "I hate rector") {
                $item->value = 'I love rector';
            }
        }
        return $node;
    }
}

<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use Rector\Rector\AbstractRector;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\MakeInArrayStrictRector\MakeInArrayStrictRectorTest
 */
final class MakeInArrayStrictRector extends AbstractRector
{
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Node\Expr\FuncCall::class];
    }

    /**
     * @param Node\Expr\FuncCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($this->isName($node->name, 'in_array')) {
            $node->args[2] = new Node\Arg($this->nodeFactory->createTrue());
        }
        return $node;
    }
}

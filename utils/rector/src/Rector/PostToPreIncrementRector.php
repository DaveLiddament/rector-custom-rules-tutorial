<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\PostToPreIncrementRector\PostToPreIncrementRectorTest
 */
final class PostToPreIncrementRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Post to pre-increment', [
            new CodeSample(
                <<<'CODE_SAMPLE'
$count++;
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
++$count;
CODE_SAMPLE
            ),
        ]);
    }

    /**
     * @return array<class-string<Node\Expr\PostInc>>
     */
    public function getNodeTypes(): array
    {
        return [Node\Expr\PostInc::class];
    }

    /**
     * @param Node\Expr\PostInc $node
     */
    public function refactor(Node $node): ?Node
    {
        return new Node\Expr\PreInc($node->var);
    }
}

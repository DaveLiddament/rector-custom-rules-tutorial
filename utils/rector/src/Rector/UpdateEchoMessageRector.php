<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\UpdateEchoMessageRector\UpdateEchoMessageRectorTest
 */
final class UpdateEchoMessageRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Update echo message', [
            new CodeSample(
                <<<'CODE_SAMPLE'
echo 'I hate rector';
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
echo 'I love rector';
CODE_SAMPLE
            ),
        ]);
    }

    /**
     * @return array<class-string<Node\Stmt\Echo_>>
     */
    public function getNodeTypes(): array
    {
        return [Node\Stmt\Echo_::class];
    }

    /**
     * @param \PhpParser\Node\Stmt\Echo_ $node
     */
    public function refactor(Node $node): ?Node
    {
        $exprs = $node->exprs;
        if (count($exprs) !== 1) {
            return null;
        }

        $firstExpression = $exprs[0];
        if ($firstExpression instanceof Node\Scalar\String_) {
            if ($firstExpression->value === 'I hate rector') {
                $firstExpression->value = 'I love rector';
                return $node;
            }
        }

        return null;
    }
}

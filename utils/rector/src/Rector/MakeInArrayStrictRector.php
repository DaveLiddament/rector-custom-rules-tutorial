<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\MakeInArrayStrictRector\MakeInArrayStrictRectorTest
 */
final class MakeInArrayStrictRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Make in_array strict', [
            new CodeSample(
                <<<'CODE_SAMPLE'
in_array($a, $b):
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
in_array($a, $b, true):
CODE_SAMPLE
            ),
        ]);
    }

    /**
     * @return array<class-string<Node\Expr\FuncCall>>
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
        if (! $this->isName($node, 'in_array')) {
            return null;
        }

        $arg = $this->nodeFactory->createArg(true);
        $node->args[2] = $arg;
        return $node;
    }
}

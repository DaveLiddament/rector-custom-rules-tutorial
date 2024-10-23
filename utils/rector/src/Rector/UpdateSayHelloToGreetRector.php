<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use PhpParser\Node\Name;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\UpdateSayHelloToGreetRector\UpdateSayHelloToGreetRectorTest
 */
final class UpdateSayHelloToGreetRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Convert sayHello to greet', [
            new CodeSample(
                <<<'CODE_SAMPLE'
sayHello("Jane");
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
greet("Jane");
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
        if (! $this->isName($node, 'sayHello')) {
            return null;
        }

        $node->name = new Name('greet');
        return $node;
    }
}

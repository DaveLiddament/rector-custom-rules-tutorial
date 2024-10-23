<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise07\Tombstone;
use PhpParser\Node;
use PHPStan\Analyser\Scope;
use Rector\Rector\AbstractScopeAwareRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\AddTombstoneRector\AddTombstoneRectorTest
 */
final class AddTombstoneRector extends AbstractScopeAwareRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('// Add tombstone', [
            new CodeSample(
                <<<'CODE_SAMPLE'
class Foo {
    public function bar(): void {
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
class Foo {
    public function bar(): void {
        Tombstone::trigger('Foo', 'bar');
    }
}
CODE_SAMPLE
            ),
        ]);
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Node\Stmt\ClassMethod::class];
    }

    /**
     * @param \PhpParser\Node\Stmt\ClassMethod $node
     */
    public function refactorWithScope(Node $node, Scope $scope): ?Node
    {

        $className = $scope->getClassReflection()?->getName() ?? null;
        if ($className === null) {
            return null;
        }

        $staticCall = $this->nodeFactory->createStaticCall(
            Tombstone::class,
            'trigger',
            [
                $this->nodeFactory->createArg($className),
                $this->nodeFactory->createArg($node->name->name),
            ]
        );

        $staticCallStatement = new Node\Stmt\Expression($staticCall);

        $statements = $node->stmts ?? [];
        array_unshift($statements, $staticCallStatement);
        $node->stmts = $statements;

        return $node;
    }
}

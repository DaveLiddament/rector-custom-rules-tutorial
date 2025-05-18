<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise07\Tombstone;
use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\PHPStan\ScopeFetcher;
use Rector\Rector\AbstractRector;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\AddTombstoneRector\AddTombstoneRectorTest
 */
final class AddTombstoneRector extends AbstractRector
{
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }

    /**
     * @param ClassMethod $node
     */
    public function refactor(Node $node): ?Node
    {
        $scope = ScopeFetcher::fetch($node);
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

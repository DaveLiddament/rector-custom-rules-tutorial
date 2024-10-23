<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise07\Tombstone;
use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Analyser\Scope;
use PHPStan\Type\ObjectType;
use Rector\Contract\Rector\ConfigurableRectorInterface;
use Rector\Rector\AbstractScopeAwareRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\RemoveTriggeredTombstonesRector\RemoveTriggeredTombstonesRectorTest
 */
final class RemoveTriggeredTombstonesRector extends AbstractScopeAwareRector implements ConfigurableRectorInterface
{
    /** @var array<mixed> */
    private array $triggeredTombstones;

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Remove triggered tombstones', [
            new ConfiguredCodeSample(
                <<<'CODE_SAMPLE'
class Foo 
{
    function bar(): void {
        Tombstone::trigger('Foo', 'bar');
    }
}    
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
class Foo 
{
    function bar(): void {
        Tombstone::trigger('Foo', 'bar');
    }
}    
CODE_SAMPLE
            ),
            [
                ['className', 'methodName'],
                ['className', 'methodName'],
            ]
        ]);
    }

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
    public function refactorWithScope(Node $node, Scope $scope): ?Node
    {
        $className = $scope->getClassReflection()?->getName();
        if ($className === null) {
            return null;
        }


        $methodName = $node->name->name;

        if (!$this->isTriggeredTombstone($className, $methodName)) {
            return null;
        }

        $statements = $node->getStmts() ?? [];
        $found = false;
        $updatedStatements = [];

        foreach ($statements as $statement) {
            if ($this->isTombstoneTriggerStaticCall($statement)) {
                $found = true;
            } else {
                $updatedStatements[] = $statement;
            }
        }

        if (!$found) {
            return null;
        }

        $node->stmts = $updatedStatements;

        return $node;
    }

    public function configure(array $configuration): void
    {
        $this->triggeredTombstones = $configuration;
    }

    private function isTriggeredTombstone(string $className, string $methodName): bool
    {
        foreach ($this->triggeredTombstones as [$triggeredClassName, $triggeredMethodName]) {
            if ($triggeredClassName === $className && $triggeredMethodName === $methodName) {
                return true;
            }
        }
        return false;
    }

    private function isTombstoneTriggerStaticCall(Node\Stmt $statement): bool
    {
        if (! $statement instanceof Node\Stmt\Expression) {
            return false;
        }

        $expression = $statement->expr;
        if (! $expression instanceof Node\Expr\StaticCall) {
            return false;
        }

        if ($this->getName($expression->name) !== 'trigger') {
            return false;
        }

        if (!$this->isObjectType(
            $expression->class,
            new ObjectType(Tombstone::class)
        )) {
            return false;
        }

        return true;
    }
}

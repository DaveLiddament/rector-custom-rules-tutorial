<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use PHPStan\Type\ObjectType;
use Rector\Contract\Rector\ConfigurableRectorInterface;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\UpdateMethodNameRector\UpdateMethodNameRectorTest
 */
final class UpdateMethodNameRector extends AbstractRector implements ConfigurableRectorInterface
{
    /**
     * @var array<mixed>
     */
    private array $renameDetails;

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Update method name', [
            new ConfiguredCodeSample(
                <<<'CODE_SAMPLE'
$cat->getEngine(),
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
$car->getEngineSize(),
CODE_SAMPLE
            ,
            ['className', 'oldMethodName', 'newMethodName'],
            )
        ]);
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Node\Expr\MethodCall::class];
    }

    /**
     * @param Node\Expr\MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $this->isName($node->name, $this->renameDetails[1])) {
            return null;
        }

        if (! $this->isObjectType(
            $node->var,
            new ObjectType($this->renameDetails[0])
        )) {
            return null;
        }

        $node->name = new Node\Identifier($this->renameDetails[2]);
        return $node;
    }

    public function configure(array $configuration): void
    {
        $this->renameDetails = $configuration;
    }
}

<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Type\ObjectType;
use Rector\Contract\Rector\ConfigurableRectorInterface;
use Rector\Rector\AbstractRector;
use Rector\Validation\RectorAssert;
use RectorPrefix202505\Webmozart\Assert\Assert;
use Utils\Rector\Config\MethodRename;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\UpdateMethodNameRector\UpdateMethodNameRectorTest
 */
final class UpdateMethodNameRector extends AbstractRector implements ConfigurableRectorInterface
{

    /** @var list<MethodRename> */
    private array $renameDetails;

    public function configure(array $configuration): void
    {
        Assert::allIsAOf($configuration, MethodRename::class);
        $this->renameDetails = $configuration;
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        foreach($this->renameDetails as $methodRename) {
            if (!$this->isName($node->name, $methodRename->oldMethod)) {
                continue;
            }

            if (!$this->isObjectType(
                $node->var,
                new ObjectType($methodRename->className)
            )) {
                continue;
            }

            $node->name = new Node\Identifier($methodRename->newMethod);
            return $node;
        }
        return null;
    }
}

<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\LookupService;
use PhpParser\Node;
use PHPStan\Type\ObjectType;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\AddParamterToLookupServiceCallRector\AddParamterToLookupServiceCallRectorTest
 */
final class AddParamterToLookupServiceCallRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Add parameter to calls to LookupService::lookup', [
            new CodeSample(
                <<<'CODE_SAMPLE'
$lookupService->lookup('name');
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
$lookupService->lookup('name', null);
CODE_SAMPLE
            ),
        ]);
    }

    /**
     * @return array<class-string<Node\Expr\MethodCall>>
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
        if (! $this->isName($node->name, 'lookup')) {
            return null;
        }

        if (! $this->isObjectType(
            $node->var,
            new ObjectType(LookupService::class)
        )) {
            return null;
        }

        if (count($node->args) !== 1) {
            return null;
        }

        $node->args[] = $this->nodeFactory->createArg(null);

        return $node;
    }
}

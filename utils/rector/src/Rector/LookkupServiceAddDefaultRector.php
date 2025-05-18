<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\LookupService;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Type\MixedType;
use Rector\PHPStan\ScopeFetcher;
use Rector\Rector\AbstractRector;
use PHPStan\Type\ObjectType;

/**
 * @see \Rector\Tests\TypeDeclaration\Rector\LookkupServiceAddDefaultRector\LookkupServiceAddDefaultRectorTest
 */
final class LookkupServiceAddDefaultRector extends AbstractRector
{
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [
            MethodCall::class,
            ClassMethod::class,
        ];
    }

    /**
     * @param MethodCall|ClassMethod $node
     */
    public function refactor(Node $node): ?Node
    {
        if (!$this->isName($node->name, 'lookup')) {
            return null;
        }

        if ($node instanceof MethodCall) {

            if (!$this->isObjectType($node->var, new ObjectType(LookupService::class))) {
                return null;
            }


            if (count($node->args) !== 1) {
                return null;
            }

            $node->args[] = new Node\Arg($this->nodeFactory->createNull());


            return $node;
        } else {

            $scope = ScopeFetcher::fetch($node);
            if (!$scope->getClassReflection()->is(LookupService::class))  {
                return null;
            }

            if (count($node->params) !== 1) {
                return null;
            }

            $node->params[] = $this->nodeFactory->createParamFromNameAndType(
                'default',
                new MixedType(true)
            );

            return $node;
        }
    }
}

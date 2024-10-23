<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use DaveLiddament\RectorCustomRulesWorkshop\Exercise05\Dog;
use PhpParser\Node;
use PhpParser\Node\Identifier;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use PHPStan\Type\ObjectType;


/**
 * @see \Rector\Tests\TypeDeclaration\Rector\UpdateDogMakeNoiseToBarkRector\UpdateDogMakeNoiseToBarkRectorTest
 */
final class UpdateDogMakeNoiseToBarkRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Update calls to Dog::makeNoise to bark', [
            new CodeSample(
                <<<'CODE_SAMPLE'
function (Dog $dog) {
    $dog->makeNoise();
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
function (Dog $dog) {
    $dog->bark();
}
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
        if (!$this->isName($node->name, 'makeNoise')) {
            return null;
        }

        $objectType = new ObjectType(Dog::class);
        if (!$this->isObjectType($node->var, $objectType)) {
            return null;
        }

        $node->name = new Identifier('bark');
        return $node;
    }
}

<?php declare(strict_types = 1);

namespace PHPStan\Parser;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class ArrayWalkArgVisitor extends NodeVisitorAbstract
{

	public const ATTRIBUTE_NAME = 'isArrayWalkArg';

	public function enterNode(Node $node): ?Node
	{
		if ($node instanceof Node\Expr\FuncCall && $node->name instanceof Node\Name) {
			$functionName = $node->name->toLowerString();
			if ($functionName === 'array_walk') {
				$args = $node->getArgs();
				if (isset($args[0])) {
					$args[0]->setAttribute(self::ATTRIBUTE_NAME, true);
				}
			}
		}
		return null;
	}

}

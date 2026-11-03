<?php

declare(strict_types=1);

namespace Doctrine\ORM\Query\AST;

use Doctrine\ORM\Query\SqlWalker;
use Generator;

/**
 * ArithmeticTerm ::= ArithmeticFactor {("*" | "/") ArithmeticFactor}*
 *
 * @link    www.doctrine-project.org
 */
class ArithmeticTerm extends Node
{
    /** @param mixed[] $arithmeticFactors */
    public function __construct(public array $arithmeticFactors)
    {
    }

    public function getChildNodes(): Generator
    {
        yield from self::filterNodes($this->arithmeticFactors);
    }

    public function dispatch(SqlWalker $walker): string
    {
        return $walker->walkArithmeticTerm($this);
    }
}

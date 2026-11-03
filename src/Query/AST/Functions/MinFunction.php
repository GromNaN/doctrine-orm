<?php

declare(strict_types=1);

namespace Doctrine\ORM\Query\AST\Functions;

use Doctrine\ORM\Query\AST\AggregateExpression;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;
use Generator;

/**
 * "MIN" "(" ["DISTINCT"] StringPrimary ")"
 */
final class MinFunction extends FunctionNode
{
    private AggregateExpression $aggregateExpression;

    public function getChildNodes(): Generator
    {
        yield $this->aggregateExpression;
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        return $this->aggregateExpression->dispatch($sqlWalker);
    }

    public function parse(Parser $parser): void
    {
        $this->aggregateExpression = $parser->AggregateExpression();
    }
}

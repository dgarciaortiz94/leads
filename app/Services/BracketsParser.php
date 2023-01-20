<?php

namespace App\Services;

class BracketsParser
{
    private static array $operators = [
        'equal' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>=',
        'like' => 'LIKE',
        'isnot' => 'IS NOT',
        'in' => 'IN',
        'or' => 'OR',
        'and' => 'AND',
    ];

    public static function parse(string $bracketOperator)
    {
        return BracketsParser::$operators[$bracketOperator];
    }
}
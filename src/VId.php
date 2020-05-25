<?php
/**
 * Author: Aleksandrov Artem
 * Date: 25.04.2020
 * Time: 16:54
 */

declare(strict_types=1);

namespace kradwhite\validation;

/**
 * Class VId
 * @package kradwhite\validation
 */
class VId
{
    /** @var int */
    const Max = 2147483647;

    use ValidTrait;

    /**
     * VId constructor.
     * @param int ...$vs
     */
    public function __construct(int ...$vs)
    {
        $this->values = $vs;
        $this->checkParams['id'] = self::Max;
        $this->checks['id'] = function (int $value): bool {
            return $value > 0 && $value <= self::Max;
        };
    }

    /**
     * @param int ...$vs
     * @return VId
     */
    public static function init(int ...$vs): VId
    {
        return new VId(...$vs);
    }
}
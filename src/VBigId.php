<?php
/**
 * Author: Aleksandrov Artem
 * Date: 25.04.2020
 * Time: 16:59
 */

declare(strict_types=1);

namespace kradwhite\validation;

/**
 * Class VBigId
 * @package kradwhite\validation
 */
class VBigId
{
    use ValidTrait;

    /**
     * VId constructor.
     * @param int ...$vs
     */
    public function __construct(int ...$vs)
    {
        $this->values = $vs;
        $this->checkParams['id'][] = PHP_INT_MAX;
        $this->checks['id'][] = function (int $value): bool {
            return $value > 0 && $value <= PHP_INT_MAX;
        };
    }

    /**
     * @param int ...$vs
     * @return VId
     */
    public static function init(int ...$vs): VBigId
    {
        return new VBigId(...$vs);
    }
}
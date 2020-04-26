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
    /**
     * @param int $v
     * @return bool
     */
    public static function check(int $v): bool
    {
        return $v > 0 && $v <= PHP_INT_MAX;
    }
}
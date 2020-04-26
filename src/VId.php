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
    /**
     * @param int $v
     * @return bool
     */
    public static function check(int $v): bool
    {
        return $v > 0 && $v <= 2147483647;
    }
}
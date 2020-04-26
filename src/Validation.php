<?php
/**
 * Author: Aleksandrov Artem
 * Date: 2020-04-25
 * Time: 14:56:59
 */

declare(strict_types=1);

namespace kradwhite\validation;

/**
 * Interface Validation
 * @package kradwhite\validation
 */
interface Validation {

    /**
     * @return bool
     */
    public function check(): bool;
}

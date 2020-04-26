<?php
/**
 * Author: Aleksandrov Artem
 * Date: 2020-04-25
 * Time: 15:10:04
 */

declare(strict_types=1);

namespace kradwhite\validation;

/**
 * Trait ValidTrait
 * @package kradwhite\validation
 */
trait ValidTrait
{
    /** @var bool */
    private bool $valid = true;

    /**
     * @return bool
     */
    public function check(): bool
    {
        return $this->valid;
    }
}

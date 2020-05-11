<?php
/**
 * Author: Aleksandrov Artem
 * Date: 2020-04-25
 * Time: 15:10:04
 */

declare(strict_types=1);

namespace kradwhite\validation;

use phpDocumentor\Reflection\Types\Callable_;

/**
 * Trait ValidTrait
 * @package kradwhite\validation
 */
trait ValidTrait
{
    /** @var int|float|string[] */
    private array $values;

    /** @var callable[] */
    private array $rules = [];

    /**
     * @return bool
     */
    public function check(): bool
    {
        for ($i = 0; $i < count($this->rules); $i++) {
            for ($j = 0; $j < count($this->values); $j++) {
                if (!$this->rules[$i]($this->values[$j])) {
                    return false;
                }
            }
        }
        return true;
    }
}

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
    /** @var int|float|string[] */
    private array $values;

    /** @var callable[] */
    private array $check = [];

    /** @var array */
    private array $checkParams = [];

    /** @var string */
    private string $errorId = '';

    /**
     * @return bool
     */
    public function check(): bool
    {
        foreach ($this->check as $errorKey => $rule) {
            for ($j = 0; $j < count($this->values); $j++) {
                if (!$rule($this->values[$j])) {
                    $this->errorId = $errorKey;
                    return false;
                }
            }
        }
        return true;
    }
}

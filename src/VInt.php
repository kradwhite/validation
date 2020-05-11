<?php
/**
 * Author: Aleksandrov Artem
 * Date: 2020-04-25
 * Time: 15:00:04
 */

declare(strict_types=1);

namespace kradwhite\validation;

/**
 * Class Validation
 * @package kradwhite\validation
 */
class VInt implements Validation
{
    use ValidTrait;

    /**
     * @param int ...$v
     */
    public function __construct(int ...$v)
    {
        $this->values = $v;
    }

    /**
     * @param int ...$v
     * @return VInt
     */
    public static function init(int ...$v)
    {
        return new VInt(...$v);
    }

    /**
     * @param int $l
     * @param int $r
     * @return VInt
     */
    public function between(int $l, int $r): VInt
    {
        $this->rules[] = function (int $value) use ($l, $r): bool {
            return $value > $l && $value < $r;
        };
        return $this;
    }

    /**
     * @param int $l
     * @param int $r
     * @return VInt
     */
    public function betweenEq(int $l, int $r): VInt
    {
        $this->rules[] = function (int $value) use ($l, $r): bool {
            return $value >= $l && $value <= $r;
        };
        return $this;
    }

    /**
     * @return VInt
     */
    public function zero(): VInt
    {
        $this->rules[] = function (int $value): bool {
            return $value === 0;
        };
        return $this;
    }

    /**
     * @param int $t
     * @return VInt
     */
    public function eq(int $t): VInt
    {
        $this->rules[] = function (int $value) use ($t): bool {
            return $value === $t;
        };
        return $this;
    }

    /**
     * @param int $t
     * @return $this
     */
    public function higher(int $t): VInt
    {
        $this->rules[] = function (int $value) use ($t): bool {
            return $value > $t;
        };
        return $this;
    }

    /**
     * @param int $t
     * @return $this
     */
    public function lower(int $t): VInt
    {
        $this->rules[] = function (int $value) use ($t): bool {
            return $value < $t;
        };
        return $this;
    }

    /**
     * @param int $t
     * @return $this
     */
    public function higherEq(int $t): VInt
    {
        $this->rules[] = function (int $value) use ($t): bool {
            return $value >= $t;
        };
        return $this;
    }

    /**
     * @param int $t
     * @return $this
     */
    public function lowerEq(int $t): VInt
    {
        $this->rules[] = function (int $value) use ($t): bool {
            return $value <= $t;
        };
        return $this;
    }

    /**
     * @param int $t
     * @return VInt
     */
    public function notEq(int $t): VInt
    {
        $this->rules[] = function (int $value) use ($t): bool {
            return $value !== $t;
        };
        return $this;
    }

    /**
     * @return VInt
     */
    public function notZero(): VInt
    {
        $this->rules[] = function (int $value): bool {
            return $value !== 0;
        };
        return $this;
    }

    /**
     * @param int $l
     * @param int $r
     * @return VInt
     */
    public function notBetween(int $l, int $r): VInt
    {
        $this->rules[] = function (int $value) use ($l, $r): bool {
            return $value < $l || $value > $r;
        };
        return $this;
    }

    /**
     * @param int $l
     * @param int $r
     * @return VInt
     */
    public function notBetweenEq(int $l, int $r): VInt
    {
        $this->rules[] = function (int $value) use ($l, $r): bool {
            return $value <= $l || $value >= $r;
        };
        return $this;
    }

    /**
     * @return VInt
     */
    public function negative(): VInt
    {
        $this->rules[] = function (int $value): bool {
            return $value < 0;
        };
        return $this;
    }

    /**
     * @return VInt
     */
    public function positive(): VInt
    {
        $this->rules[] = function (int $value): bool {
            return $value > 0;
        };
        return $this;
    }
}

<?php
/**
 * Author: Aleksandrov Artem
 * Date: 25.04.2020
 * Time: 16:09
 */

declare(strict_types=1);

namespace kradwhite\validation;

/**
 * Class VString
 * @package kradwhite\validation
 */
class VString implements Validation
{
    use ValidTrait;

    /**
     * VString constructor.
     * @param string ...$v
     */
    public function __construct(string ...$v)
    {
        $this->values = $v;
    }

    /**
     * @param string ...$v
     * @return VString
     */
    public static function init(string ...$v): VString
    {
        return new VString(...$v);
    }

    /**
     * @param int $c
     * @return VString
     */
    public function longer(int $c): VString
    {
        $this->rules[] = function (string $value) use ($c) {
            return strlen($value) > $c;
        };
        return $this;
    }

    /**
     * @param int $c
     * @return $this
     */
    public function shorter(int $c): VString
    {
        $this->rules[] = function (string $value) use ($c) {
            return strlen($value) < $c;
        };
        return $this;
    }

    /**
     * @param int $c
     * @return VString
     */
    public function longerEq(int $c): VString
    {
        $this->rules[] = function (string $value) use ($c): bool {
            return strlen($value) >= $c;
        };
        return $this;
    }

    /**
     * @param int $c
     * @return $this
     */
    public function shorterEq(int $c): VString
    {
        $this->rules[] = function (string $value) use ($c): bool {
            return strlen($value) <= $c;
        };
        return $this;
    }

    /**
     * @param int $c
     * @return $this
     */
    public function length(int $c): VString
    {
        $this->rules[] = function (string $value) use ($c): bool {
            return strlen($value) === $c;
        };
        return $this;
    }

    /**
     * @param string $t
     * @return VString
     */
    public function equals(string $t): VString
    {
        $this->rules[] = function (string $value) use (&$t): bool {
            return $value == $t;
        };
        return $this;
    }

    /**
     * @param string $t
     * @return $this
     */
    public function notEquals(string $t): VString
    {
        $this->rules[] = function (string $value) use (&$t): bool {
            return $value != $t;
        };
        return $this;
    }

    /**
     * @param int $l
     * @param int $r
     * @return $this
     */
    public function between(int $l, int $r): VString
    {
        $this->rules[] = function (string $value) use ($l, $r): bool {
            $len = strlen($value);
            return $len > $l && $len < $r;
        };
        return $this;
    }

    /**
     * @param int $l
     * @param int $r
     * @return $this
     */
    public function betweenEq(int $l, int $r): VString
    {
        $this->rules[] = function (string $value) use ($l, $r): bool {
            $len = strlen($value);
            return $len >= $l && $len <= $r;
        };
        return $this;
    }

    /**
     * @param int $l
     * @param int $r
     * @return $this
     */
    public function notBetween(int $l, int $r): VString
    {
        $this->rules[] = function (string $value) use ($l, $r): bool {
            $len = strlen($value);
            return $len < $l || $len > $r;
        };
        return $this;
    }

    /**
     * @param int $l
     * @param int $r
     * @return $this
     */
    public function notBetweenEq(int $l, int $r): VString
    {
        $this->rules[] = function (string $value) use ($l, $r): bool {
            $len = strlen($value);
            return $len <= $l || $len >= $r;
        };
        return $this;
    }

    /**
     * @param string $p
     * @return $this
     * @throws ValidationException
     */
    public function match(string $p): VString
    {
        $this->rules[] = function (string $value) use (&$p): bool {
            $result = preg_match($p, $value);
            if (is_bool($result)) {
                throw new ValidationException(preg_last_error());
            }
            return (bool)$result;
        };
        return $this;
    }

    /**
     * @param string $t
     * @return VString
     */
    public function contains(string $t): VString
    {
        $this->rules[] = function (string $value) use (&$t): bool {
            return !is_bool(strpos($value, $t));
        };
        return $this;
    }

    /**
     * @param string $t
     * @return VString
     */
    public function notContains(string $t): VString
    {
        $this->rules[] = function (string $value) use (&$t): bool {
            return is_bool(strpos($value, $t));
        };
        return $this;
    }

    /**
     * @return $this
     */
    public function digits(): VString
    {
        $this->rules[] = function (string $value): bool {
            return ctype_digit($value);
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function notDigits(): VString
    {
        $this->rules[] = function (string $value): bool {
            return !ctype_digit($value);
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function alpha(): VString
    {
        $this->rules[] = function (string $value): bool {
            return ctype_alpha($value);
        };
        return $this;
    }

    /**
     * @return $this
     */
    public function notAlpha(): VString
    {
        $this->rules[] = function (string $value): bool {
            return !ctype_alpha($value);
        };
        return $this;
    }

    /**
     * @return $this
     */
    public function alphaDigits(): VString
    {
        $this->rules[] = function (string $value): bool {
            return ctype_alnum($value);
        };
        return $this;
    }

    /**
     * @return $this
     */
    public function notAlphaDigits(): VString
    {
        $this->rules[] = function (string $value): bool {
            return !ctype_alnum($value);
        };
        return $this;
    }

    /**
     * @param string $t
     * @return VString
     */
    public function prefix(string $t): VString
    {
        $this->rules[] = function (string $value) use (&$t): bool {
            return strpos($value, $t) === 0;
        };
        return $this;
    }

    /**
     * @param string $t
     * @return $this
     */
    public function suffix(string $t): VString
    {
        $this->rules[] = function (string $value) use (&$t): bool {
            return strpos($value, $t) === strlen($value) - strlen($t);
        };
        return $this;
    }
}
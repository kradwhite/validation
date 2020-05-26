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
        $this->checkParams['longer'][] = $c;
        $this->checks['longer'][] = function (string $value, int $i): bool {
            return strlen($value) > $this->checkParams['longer'][$i];
        };
        return $this;
    }

    /**
     * @param int $c
     * @return $this
     */
    public function shorter(int $c): VString
    {
        $this->checkParams['shorter'][] = $c;
        $this->checks['shorter'][] = function (string $value, int $i) {
            return strlen($value) < $this->checkParams['shorter'][$i];
        };
        return $this;
    }

    /**
     * @param int $c
     * @return VString
     */
    public function longerEq(int $c): VString
    {
        $this->checkParams['longerEq'][] = $c;
        $this->checks['longerEq'][] = function (string $value, int $i): bool {
            return strlen($value) >= $this->checkParams['longerEq'][$i];
        };
        return $this;
    }

    /**
     * @param int $c
     * @return $this
     */
    public function shorterEq(int $c): VString
    {
        $this->checkParams['shorterEq'][] = $c;
        $this->checks['shorterEq'][] = function (string $value, int $i): bool {
            return strlen($value) <= $this->checkParams['shorterEq'][$i];
        };
        return $this;
    }

    /**
     * @param int $c
     * @return $this
     */
    public function length(int $c): VString
    {
        $this->checkParams['length'][] = $c;
        $this->checks['length'][] = function (string $value, int $i): bool {
            return strlen($value) === $this->checkParams['length'][$i];
        };
        return $this;
    }

    /**
     * @param string $t
     * @return VString
     */
    public function equals(string $t): VString
    {
        $this->checkParams['equals'][] = $t;
        $this->checks['equals'][] = function (string $value, int $i): bool {
            return $value == $this->checkParams['equals'][$i];
        };
        return $this;
    }

    /**
     * @param string $t
     * @return $this
     */
    public function notEquals(string $t): VString
    {
        $this->checkParams['notEquals'][] = $t;
        $this->checks['notEquals'][] = function (string $value, int $i): bool {
            return $value != $this->checkParams['notEquals'][$i];
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
        $this->checkParams['strBetween'][] = [$l, $r];
        $this->checks['strBetween'][] = function (string $value, int $i): bool {
            $len = strlen($value);
            return $len > $this->checkParams['strBetween'][$i][0] && $len < $this->checkParams['strBetween'][$i][1];
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
        $this->checkParams['strBetweenEq'][] = [$l, $r];
        $this->checks['strBetweenEq'][] = function (string $value, int $i): bool {
            $len = strlen($value);
            return $len >= $this->checkParams['strBetweenEq'][$i][0] && $len <= $this->checkParams['strBetweenEq'][$i][1];
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
        $this->checkParams['strNotBetween'][] = [$l, $r];
        $this->checks['strNotBetween'][] = function (string $value, int $i): bool {
            $len = strlen($value);
            return $len < $this->checkParams['strNotBetween'][$i][0] || $len > $this->checkParams['strNotBetween'][$i][1];
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
        $this->checkParams['strNotBetweenEq'][] = [$l, $r];
        $this->checks['strNotBetweenEq'][] = function (string $value, int $i): bool {
            $len = strlen($value);
            return $len <= $this->checkParams['strNotBetweenEq'][$i][0] || $len >= $this->checkParams['strNotBetweenEq'][$i][1];
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
        $this->checkParams['match'][] = $p;
        $this->checks['match'][] = function (string $value, int $i): bool {
            $result = preg_match($this->checkParams['match'][$i], $value);
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
        $this->checkParams['contains'][] = $t;
        $this->checks['contains'][] = function (string $value, int $i): bool {
            return !is_bool(strpos($value, $this->checkParams['contains'][$i]));
        };
        return $this;
    }

    /**
     * @param string $t
     * @return VString
     */
    public function notContains(string $t): VString
    {
        $this->checkParams['notContains'][] = $t;
        $this->checks['notContains'][] = function (string $value, int $i): bool {
            return is_bool(strpos($value, $this->checkParams['notContains'][$i]));
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function digits(): VString
    {
        $this->checks['digits'][] = function (string $value, int $i): bool {
            return ctype_digit($value);
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function notDigits(): VString
    {
        $this->checks['notDigits'][] = function (string $value, int $i): bool {
            return !ctype_digit($value);
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function alpha(): VString
    {
        $this->checks['alpha'][] = function (string $value, int $i): bool {
            return ctype_alpha($value);
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function notAlpha(): VString
    {
        $this->checks['notAlpha'][] = function (string $value, int $i): bool {
            return !ctype_alpha($value);
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function alphaDigits(): VString
    {
        $this->checks['alphaDigits'][] = function (string $value, int $i): bool {
            return ctype_alnum($value);
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function notAlphaDigits(): VString
    {
        $this->checks['notAlphaDigits'][] = function (string $value, int $i): bool {
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
        $this->checkParams['prefix'][] = $t;
        $this->checks['prefix'][] = function (string $value, int $i): bool {
            return strpos($value, $this->checkParams['prefix'][$i]) === 0;
        };
        return $this;
    }

    /**
     * @param string $t
     * @return VString
     */
    public function suffix(string $t): VString
    {
        $this->checkParams['suffix'][] = $t;
        $this->checks['suffix'][] = function (string $value, int $i): bool {
            return strpos($value, $this->checkParams['suffix'][$i]) === strlen($value) - strlen($this->checkParams['suffix'][$i]);
        };
        return $this;
    }

    /**
     * @param string ...$vs
     * @return VString
     */
    public function in(string ...$vs): VString
    {
        $this->checkParams['in'][] = $vs;
        $this->checks['in'][] = function (string $value, int $i): bool {
            if (!$result = in_array($value, $this->checkParams['in'][$i])) {
                $this->checkParams['in'][$i] = '[' . implode(', ', $this->checkParams['in'][$i]) . ']';
            }
            return $result;
        };
        return $this;
    }

    /**
     * @param string ...$vs
     * @return VString
     */
    public function notIn(string ...$vs): VString
    {
        $this->checkParams['notIn'][] = $vs;
        $this->checks['notIn'][] = function (string $value, int $i): bool {
            if (!$result = !in_array($value, $this->checkParams['notIn'][$i])) {
                $this->checkParams['notIn'][$i] = '[' . implode(', ', $this->checkParams['notIn'][$i]) . ']';
            }
            return $result;
        };
        return $this;
    }
}
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
        $this->checkParams['longer'] = $c;
        $this->checks['longer'] = function (string $value): bool {
            return strlen($value) > $this->checkParams['longer'];
        };
        return $this;
    }

    /**
     * @param int $c
     * @return $this
     */
    public function shorter(int $c): VString
    {
        $this->checkParams['shorter'] = $c;
        $this->checks['shorter'] = function (string $value) {
            return strlen($value) < $this->checkParams['shorter'];
        };
        return $this;
    }

    /**
     * @param int $c
     * @return VString
     */
    public function longerEq(int $c): VString
    {
        $this->checkParams['longerEq'] = $c;
        $this->checks['longerEq'] = function (string $value): bool {
            return strlen($value) >= $this->checkParams['longerEq'];
        };
        return $this;
    }

    /**
     * @param int $c
     * @return $this
     */
    public function shorterEq(int $c): VString
    {
        $this->checkParams['shorterEq'] = $c;
        $this->checks['shorterEq'] = function (string $value): bool {
            return strlen($value) <= $this->checkParams['shorterEq'];
        };
        return $this;
    }

    /**
     * @param int $c
     * @return $this
     */
    public function length(int $c): VString
    {
        $this->checkParams['length'] = $c;
        $this->checks['length'] = function (string $value): bool {
            return strlen($value) === $this->checkParams['length'];
        };
        return $this;
    }

    /**
     * @param string $t
     * @return VString
     */
    public function equals(string $t): VString
    {
        $this->checkParams['equals'] = $t;
        $this->checks['equals'] = function (string $value): bool {
            return $value == $this->checkParams['equals'];
        };
        return $this;
    }

    /**
     * @param string $t
     * @return $this
     */
    public function notEquals(string $t): VString
    {
        $this->checkParams['notEquals'] = $t;
        $this->checks['notEquals'] = function (string $value): bool {
            return $value != $this->checkParams['notEquals'];
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
        $this->checkParams['strBetween'] = [$l, $r];
        $this->checks['strBetween'] = function (string $value): bool {
            $len = strlen($value);
            return $len > $this->checkParams['strBetween'][0] && $len < $this->checkParams['strBetween'][1];
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
        $this->checkParams['strBetweenEq'] = [$l, $r];
        $this->checks['strBetweenEq'] = function (string $value): bool {
            $len = strlen($value);
            return $len >= $this->checkParams['strBetweenEq'][0] && $len <= $this->checkParams['strBetweenEq'][1];
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
        $this->checkParams['strNotBetween'] = [$l, $r];
        $this->checks['strNotBetween'] = function (string $value): bool {
            $len = strlen($value);
            return $len < $this->checkParams['strNotBetween'][0] || $len > $this->checkParams['strNotBetween'][1];
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
        $this->checkParams['strNotBetweenEq'] = [$l, $r];
        $this->checks['strNotBetweenEq'] = function (string $value): bool {
            $len = strlen($value);
            return $len <= $this->checkParams['strNotBetweenEq'][0] || $len >= $this->checkParams['strNotBetweenEq'][1];
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
        $this->checkParams['match'] = $p;
        $this->checks['match'] = function (string $value): bool {
            $result = preg_match($this->checkParams['match'], $value);
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
        $this->checkParams['contains'] = $t;
        $this->checks['contains'] = function (string $value): bool {
            return !is_bool(strpos($value, $this->checkParams['contains']));
        };
        return $this;
    }

    /**
     * @param string $t
     * @return VString
     */
    public function notContains(string $t): VString
    {
        $this->checkParams['notContains'] = $t;
        $this->checks['notContains'] = function (string $value): bool {
            return is_bool(strpos($value, $this->checkParams['notContains']));
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function digits(): VString
    {
        $this->checks['digits'] = function (string $value): bool {
            return ctype_digit($value);
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function notDigits(): VString
    {
        $this->checks['notDigits'] = function (string $value): bool {
            return !ctype_digit($value);
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function alpha(): VString
    {
        $this->checks['alpha'] = function (string $value): bool {
            return ctype_alpha($value);
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function notAlpha(): VString
    {
        $this->checks['notAlpha'] = function (string $value): bool {
            return !ctype_alpha($value);
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function alphaDigits(): VString
    {
        $this->checks['alphaDigits'] = function (string $value): bool {
            return ctype_alnum($value);
        };
        return $this;
    }

    /**
     * @return VString
     */
    public function notAlphaDigits(): VString
    {
        $this->checks['notAlphaDigits'] = function (string $value): bool {
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
        $this->checkParams['prefix'] = $t;
        $this->checks['prefix'] = function (string $value): bool {
            return strpos($value, $this->checkParams['prefix']) === 0;
        };
        return $this;
    }

    /**
     * @param string $t
     * @return VString
     */
    public function suffix(string $t): VString
    {
        $this->checkParams['suffix'] = $t;
        $this->checks['suffix'] = function (string $value): bool {
            return strpos($value, $this->checkParams['suffix']) === strlen($value) - strlen($this->checkParams['suffix']);
        };
        return $this;
    }

    /**
     * @param string ...$vs
     * @return VString
     */
    public function in(string ...$vs): VString
    {
        $this->checkParams['in'] = $vs;
        $this->checks['in'] = function (string $value): bool {
            return in_array($value, $this->checkParams['in']);
        };
        return $this;
    }

    /**
     * @param string ...$vs
     * @return VString
     */
    public function notIn(string ...$vs): VString
    {
        $this->checkParams['notIn'] = $vs;
        $this->checks['notIn'] = function (string $value): bool {
            return !in_array($value, $this->checkParams['notIn']);
        };
        return $this;
    }
}
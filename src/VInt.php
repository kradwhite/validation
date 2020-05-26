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
        $this->checkParams['between'][] = [$l, $r];
        $this->checks['between'][] = function (int $value, int $i): bool {
            return $value > $this->checkParams['between'][$i][0] && $value < $this->checkParams['between'][$i][1];
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
        $this->checkParams['betweenEq'][] = [$l, $r];
        $this->checks['betweenEq'][] = function (int $value, int $i): bool {
            return $value >= $this->checkParams['betweenEq'][$i][0] && $value <= $this->checkParams['betweenEq'][$i][1];
        };
        return $this;
    }

    /**
     * @return VInt
     */
    public function zero(): VInt
    {
        $this->checks['zero'][] = function (int $value, int $i): bool {
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
        $this->checkParams['eq'][] = $t;
        $this->checks['eq'][] = function (int $value, int $i): bool {
            return $value === $this->checkParams['eq'][$i];
        };
        return $this;
    }

    /**
     * @param int $t
     * @return VInt
     */
    public function higher(int $t): VInt
    {
        $this->checkParams['higher'][] = $t;
        $this->checks['higher'][] = function (int $value, int $i): bool {
            return $value > $this->checkParams['higher'][$i];
        };
        return $this;
    }

    /**
     * @param int $t
     * @return VInt
     */
    public function lower(int $t): VInt
    {
        $this->checkParams['lower'][] = $t;
        $this->checks['lower'][] = function (int $value, int $i): bool {
            return $value < $this->checkParams['lower'][$i];
        };
        return $this;
    }

    /**
     * @param int $t
     * @return VInt
     */
    public function higherEq(int $t): VInt
    {
        $this->checkParams['higherEq'][] = $t;
        $this->checks['higherEq'][] = function (int $value, int $i): bool {
            return $value >= $this->checkParams['higherEq'][$i];
        };
        return $this;
    }

    /**
     * @param int $t
     * @return VInt
     */
    public function lowerEq(int $t): VInt
    {
        $this->checkParams['lowerEq'][] = $t;
        $this->checks['lowerEq'][] = function (int $value, int $i): bool {
            return $value <= $this->checkParams['lowerEq'][$i];
        };
        return $this;
    }

    /**
     * @param int $t
     * @return VInt
     */
    public function notEq(int $t): VInt
    {
        $this->checkParams['notEq'][] = $t;
        $this->checks['notEq'][] = function (int $value, int $i): bool {
            return $value !== $this->checkParams['notEq'][$i];
        };
        return $this;
    }

    /**
     * @return VInt
     */
    public function notZero(): VInt
    {
        $this->checks['notZero'][] = function (int $value, int $i): bool {
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
        $this->checkParams['notBetween'][] = [$l, $r];
        $this->checks['notBetween'][] = function (int $value, int $i): bool {
            return $value < $this->checkParams['notBetween'][$i][0] || $value > $this->checkParams['notBetween'][$i][1];
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
        $this->checkParams['notBetweenEq'][] = [$l, $r];
        $this->checks['notBetweenEq'][] = function (int $value, int $i): bool {
            return $value <= $this->checkParams['notBetweenEq'][$i][0] || $value >= $this->checkParams['notBetweenEq'][$i][1];
        };
        return $this;
    }

    /**
     * @return VInt
     */
    public function negative(): VInt
    {
        $this->checks['negative'][] = function (int $value, int $i): bool {
            return $value < 0;
        };
        return $this;
    }

    /**
     * @return VInt
     */
    public function positive(): VInt
    {
        $this->checks['positive'][] = function (int $value, int $i): bool {
            return $value > 0;
        };
        return $this;
    }

    /**
     * @param int ...$vs
     * @return VInt
     */
    public function in(int ...$vs): VInt
    {
        $this->checkParams['in'][] = $vs;
        $this->checks['in'][] = function (int $value, int $i): bool {
            if (!$result = in_array($value, $this->checkParams['in'][$i])) {
                $this->checkParams['in'][$i] = implode(', ', $this->checkParams['in'][$i]);
            }
            return $result;
        };
        return $this;
    }

    /**
     * @param int ...$vs
     * @return VInt
     */
    public function notIn(int ...$vs): VInt
    {
        $this->checkParams['notIn'][] = $vs;
        $this->checks['notIn'][] = function (int $value, int $i): bool {
            if (!$result = !in_array($value, $this->checkParams['notIn'][$i])) {
                $this->checkParams['notIn'][$i] = implode(', ', $this->checkParams['notIn'][$i]);
            }
            return $result;
        };
        return $this;
    }
}

<?php
/**
 * Author: Aleksandrov Artem
 * Date: 25.04.2020
 * Time: 16:05
 */

declare(strict_types=1);

namespace kradwhite\validation;

/**
 * Class VFloat
 * @package kradwhite\validation
 */
class VFloat implements Validation
{
    use ValidTrait;

    /**
     * @param float ...$v
     */
    public function __construct(float ...$v)
    {
        $this->values = $v;
    }

    /**
     * @param float ...$v
     * @return VFloat
     */
    public static function init(float ...$v)
    {
        return new VFloat(...$v);
    }

    /**
     * @param float $l
     * @param float $r
     * @return VFloat
     */
    public function between(float $l, float $r): VFloat
    {
        $this->checkParams['between'][] = [$l, $r];
        $this->checks['between'][] = function (float $value, int $i): bool {
            return $value > $this->checkParams['between'][$i][0] && $value < $this->checkParams['between'][$i][1];
        };
        return $this;
    }

    /**
     * @param float $l
     * @param float $r
     * @return VFloat
     */
    public function betweenEq(float $l, float $r): VFloat
    {
        $this->checkParams['betweenEq'][] = [$l, $r];
        $this->checks['betweenEq'][] = function (float $value, int $i): bool {
            return $value >= $this->checkParams['betweenEq'][$i][0] && $value <= $this->checkParams['betweenEq'][$i][1];
        };
        return $this;
    }

    /**
     * @return VFloat
     */
    public function zero(): VFloat
    {
        $this->checks['zero'][] = function (float $value, int $i): bool {
            return $value === 0.0;
        };
        return $this;
    }

    /**
     * @param float $t
     * @return VFloat
     */
    public function eq(float $t): VFloat
    {
        $this->checkParams['eq'][] = $t;
        $this->checks['eq'][] = function (float $value, int $i): bool {
            return $value === $this->checkParams['eq'][$i];
        };
        return $this;
    }

    /**
     * @param float $t
     * @return VFloat
     */
    public function higher(float $t): VFloat
    {
        $this->checkParams['higher'][] = $t;
        $this->checks['higher'][] = function (float $value, int $i): bool {
            return $value > $this->checkParams['higher'][$i];
        };
        return $this;
    }

    /**
     * @param float $t
     * @return VFloat
     */
    public function lower(float $t): VFloat
    {
        $this->checkParams['lower'][] = $t;
        $this->checks['lower'][] = function (float $value, int $i): bool {
            return $value < $this->checkParams['lower'][$i];
        };
        return $this;
    }

    /**
     * @param float $t
     * @return VFloat
     */
    public function higherEq(float $t): VFloat
    {
        $this->checkParams['higherEq'][] = $t;
        $this->checks['higherEq'][] = function (float $value, int $i): bool {
            return $value >= $this->checkParams['higherEq'][$i];
        };
        return $this;
    }

    /**
     * @param float $t
     * @return VFloat
     */
    public function lowerEq(float $t): VFloat
    {
        $this->checkParams['lowerEq'][] = $t;
        $this->checks['lowerEq'][] = function (float $value, int $i): bool {
            return $value <= $this->checkParams['lowerEq'][$i];
        };
        return $this;
    }

    /**
     * @param float $t
     * @return VFloat
     */
    public function notEq(float $t): VFloat
    {
        $this->checkParams['notEq'][] = $t;
        $this->checks['notEq'][] = function (float $value, int $i): bool {
            return $value !== $this->checkParams['notEq'][$i];
        };
        return $this;
    }

    /**
     * @return VFloat
     */
    public function notZero(): VFloat
    {
        $this->checks['notZero'][] = function (float $value, int $i): bool {
            return $value !== 0.0;
        };
        return $this;
    }

    /**
     * @param float $l
     * @param float $r
     * @return VFloat
     */
    public function notBetween(float $l, float $r): VFloat
    {
        $this->checkParams['notBetween'][] = [$l, $r];
        $this->checks['notBetween'][] = function (float $value, int $i): bool {
            return $value < $this->checkParams['notBetween'][$i][0] || $value > $this->checkParams['notBetween'][$i][1];
        };
        return $this;
    }

    /**
     * @param float $l
     * @param float $r
     * @return VFloat
     */
    public function notBetweenEq(float $l, float $r): VFloat
    {
        $this->checkParams['notBetweenEq'][] = [$l, $r];
        $this->checks['notBetweenEq'][] = function (float $value, int $i): bool {
            return $value <= $this->checkParams['notBetweenEq'][$i][0] || $value >= $this->checkParams['notBetweenEq'][$i][1];
        };
        return $this;
    }

    /**
     * @return VFloat
     */
    public function negative(): VFloat
    {
        $this->checks['negative'][] = function (float $value, int $i): bool {
            return $value < 0.0;
        };
        return $this;
    }

    /**
     * @return VFloat
     */
    public function positive(): VFloat
    {
        $this->checks['positive'][] = function (float $value, int $i): bool {
            return $value > 0.0;
        };
        return $this;
    }

    /**
     * @param float ...$vs
     * @return VFloat
     */
    public function in(float ...$vs): VFloat
    {
        $this->checkParams['in'][] = $vs;
        $this->checks['in'][] = function (float $value, int $i): bool {
            if (!$result = in_array($value, $this->checkParams['in'][$i])) {
                $this->checkParams['in'][$i] = implode(', ', $this->checkParams['in'][$i]);
            }
            return $result;
        };
        return $this;
    }

    /**
     * @param float ...$vs
     * @return VFloat
     */
    public function notIn(float ...$vs): VFloat
    {
        $this->checkParams['notIn'][] = $vs;
        $this->checks['notIn'][] = function (float $value, int $i): bool {
            if (!$result = !in_array($value, $this->checkParams['notIn'][$i])) {
                $this->checkParams['notIn'][$i] = implode(', ', $this->checkParams['notIn'][$i]);
            }
            return $result;
        };
        return $this;
    }
}
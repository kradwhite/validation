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
        $this->checkParams['between'] = [$l, $r];
        $this->check['between'] = function (int $value): bool {
            return $value > $this->checkParams['between'][0] && $value < $this->checkParams['between'][1];
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
        $this->checkParams['notBetweenEq'] = [$l, $r];
        $this->check['betweenEq'] = function (int $value): bool {
            return $value >= $this->checkParams['notBetweenEq'][0] && $value <= $this->checkParams['notBetweenEq'][1];
        };
        return $this;
    }

    /**
     * @return VInt
     */
    public function zero(): VInt
    {
        $this->check['zero'] = function (int $value): bool {
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
        $this->checkParams['eq'] = $t;
        $this->check['eq'] = function (int $value): bool {
            return $value === $this->checkParams['eq'];
        };
        return $this;
    }

    /**
     * @param int $t
     * @return $this
     */
    public function higher(int $t): VInt
    {
        $this->checkParams['higher'] = $t;
        $this->check['higher'] = function (int $value): bool {
            return $value > $this->checkParams['higher'];
        };
        return $this;
    }

    /**
     * @param int $t
     * @return $this
     */
    public function lower(int $t): VInt
    {
        $this->checkParams['lower'] = $t;
        $this->check['lower'] = function (int $value): bool {
            return $value < $this->checkParams['lower'];
        };
        return $this;
    }

    /**
     * @param int $t
     * @return $this
     */
    public function higherEq(int $t): VInt
    {
        $this->checkParams['higherEq'] = $t;
        $this->check['higherEq'] = function (int $value): bool {
            return $value >= $this->checkParams['higherEq'];
        };
        return $this;
    }

    /**
     * @param int $t
     * @return $this
     */
    public function lowerEq(int $t): VInt
    {
        $this->checkParams['lowerEq'] = $t;
        $this->check['lowerEq'] = function (int $value): bool {
            return $value <= $this->checkParams['lowerEq'];
        };
        return $this;
    }

    /**
     * @param int $t
     * @return VInt
     */
    public function notEq(int $t): VInt
    {
        $this->checkParams['notEq'] = $t;
        $this->check['notEq'] = function (int $value): bool {
            return $value !== $this->checkParams['notEq'];
        };
        return $this;
    }

    /**
     * @return VInt
     */
    public function notZero(): VInt
    {
        $this->check['notZero'] = function (int $value): bool {
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
        $this->checkParams['notBetween'] = [$l, $r];
        $this->check['notBetween'] = function (int $value): bool {
            return $value < $this->checkParams['notBetween'][0] || $value > $this->checkParams['notBetween'][1];
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
        $this->checkParams['notBetweenEq'] = [$l, $r];
        $this->check['notBetweenEq'] = function (int $value) use ($l, $r): bool {
            return $value <= $this->checkParams['notBetweenEq'][0] || $value >= $this->checkParams['notBetweenEq'][1];
        };
        return $this;
    }

    /**
     * @return VInt
     */
    public function negative(): VInt
    {
        $this->check['negative'] = function (int $value): bool {
            return $value < 0;
        };
        return $this;
    }

    /**
     * @return VInt
     */
    public function positive(): VInt
    {
        $this->check['positive'] = function (int $value): bool {
            return $value > 0;
        };
        return $this;
    }

    /**
     * @param int ...$vs
     * @return $this
     */
    public function in(int ...$vs): VInt
    {
        $this->checkParams['in'] = $vs;
        $this->check['in'] = function (int $value): bool {
            return in_array($value, $this->checkParams['in']);
        };
        return $this;
    }
}

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

    /** @var float */
    private float $value;

    /**
     * @param float $v
     */
    public function __construct(float $v)
    {
        $this->value = $v;
    }

    /**
     * @param float $v
     * @return VFloat
     */
    public static function init(float $v)
    {
        return new VFloat($v);
    }

    /**
     * @param float $l
     * @param float $r
     * @return VFloat
     */
    public function between(float $l, float $r): VFloat
    {
        $this->valid = $this->valid && $this->value > $l && $this->value < $r;
        return $this;
    }

    /**
     * @param float $l
     * @param float $r
     * @return VFloat
     */
    public function betweenEq(float $l, float $r): VFloat
    {
        $this->valid = $this->valid && $this->value >= $l && $this->value <= $r;
        return $this;
    }

    /**
     * @return VFloat
     */
    public function zero(): VFloat
    {
        $this->valid = $this->valid && $this->value === 0.0;
        return $this;
    }

    /**
     * @param float $t
     * @return VFloat
     */
    public function eq(float $t): VFloat
    {
        $this->valid = $this->valid && $this->value === $t;
        return $this;
    }

    /**
     * @param float $t
     * @return $this
     */
    public function higher(float $t): VFloat
    {
        $this->valid = $this->valid && $this->value > $t;
        return $this;
    }

    /**
     * @param float $t
     * @return $this
     */
    public function lower(float $t): VFloat
    {
        $this->valid = $this->valid && $this->value < $t;
        return $this;
    }

    /**
     * @param float $t
     * @return $this
     */
    public function higherEq(float $t): VFloat
    {
        $this->valid = $this->valid && $this->value >= $t;
        return $this;
    }

    /**
     * @param float $t
     * @return $this
     */
    public function lowerEq(float $t): VFloat
    {
        $this->valid = $this->valid && $this->value <= $t;
        return $this;
    }

    /**
     * @param float $t
     * @return VFloat
     */
    public function notEq(float $t): VFloat
    {
        $this->valid = $this->valid && $this->value !== $t;
        return $this;
    }

    /**
     * @return VFloat
     */
    public function notZero(): VFloat
    {
        $this->valid = $this->valid && $this->value !== 0.0;
        return $this;
    }

    /**
     * @param float $l
     * @param float $r
     * @return VFloat
     */
    public function notBetween(float $l, float $r): VFloat
    {
        $this->valid = $this->valid && ($this->value < $l || $this->value > $r);
        return $this;
    }

    /**
     * @param float $l
     * @param float $r
     * @return VFloat
     */
    public function notBetweenEq(float $l, float $r): VFloat
    {
        $this->valid = $this->valid && ($this->value <= $l || $this->value >= $r);
        return $this;
    }

    /**
     * @return VFloat
     */
    public function negative(): VFloat
    {
        $this->valid = $this->valid && $this->value < 0.0;
        return $this;
    }

    /**
     * @return VFloat
     */
    public function positive(): VFloat
    {
        $this->valid = $this->valid && $this->value > 0.0;
        return $this;
    }
}
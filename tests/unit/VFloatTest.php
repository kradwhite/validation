<?php

namespace kradwhite\tests\unit;

use kradwhite\validation\VFloat;

class VFloatTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testBetween()
    {
        $this->assertEquals('', VFloat::init(5.22)->between(5.21, 10.3)->message('Число'));
        $this->assertEquals('Значение Число не должно выходить за пределы между 5.33 и 10.3',
            VFloat::init(5.33)->between(5.33, 10.3)->message('Число'));
    }

    public function testBetweenEq()
    {
        $this->assertEquals('', VFloat::init(5.1)->betweenEq(5.1, 10.1)->message('Число'));
        $this->assertEquals('Значение Число не должно выходить за пределы между 6.4 и 10.1 включительно',
            VFloat::init(6.3)->betweenEq(6.4, 10.1)->message('Число'));
    }

    public function testZero()
    {
        $this->assertEquals('', VFloat::init(0)->zero()->message('Число'));
        $this->assertEquals('Значение Число должно равняться нулю',
            VFloat::init(5.3)->zero()->message('Число'));
    }

    public function testEq()
    {
        $this->assertEquals('', VFloat::init(10.33)->eq(10.33)->message('Число'));
        $this->assertEquals('Значение Число должно равняться 11.33',
            VFloat::init(11.32)->eq(11.33)->message('Число'));
    }

    public function testHigher()
    {
        $this->assertEquals('', VFloat::init(10.23)->higher(10.22)->message('Число'));
        $this->assertEquals('Значение Число должно быть больше, чем 5.1',
            VFloat::init(5.1)->higher(5.1)->message('Число'));
    }

    public function testLower()
    {
        $this->assertEquals('', VFloat::init(5.2)->lower(5.3)->message('Число'));
        $this->assertEquals('Значение Число должно быть меньше, чем 5.1',
            VFloat::init(5.1)->lower(5.1)->message('Число'));
    }

    public function testHigherEq()
    {
        $this->assertEquals('', VFloat::init(10.1)->higherEq(10.1)->message('Число'));
        $this->assertEquals('Значение Число должно быть больше или равным 10.3',
            VFloat::init(10.2)->higherEq(10.3)->message('Число'));
    }

    public function testLowerEq()
    {
        $this->assertEquals('', VFloat::init(5.1)->lowerEq(5.1)->message('Число'));
        $this->assertEquals('Значение Число должно быть меньше или равным 5.1',
            VFloat::init(5.2)->lowerEq(5.1)->message('Число'));
    }

    public function testNotEq()
    {
        $this->assertEquals('', VFloat::init(5.1)->notEq(5.2)->message('Число'));
        $this->assertEquals('Значение Число не должно равняться 5.1',
            VFloat::init(5.1)->notEq(5.1)->message('Число'));
    }

    public function testNotZero()
    {
        $this->assertEquals('', VFloat::init(15.1)->notZero()->message('Число'));
        $this->assertEquals('Значение Число не должно равняться нулю',
            VFloat::init(0.0)->notZero()->message('Число'));
    }

    public function testNotBetween()
    {
        $this->assertEquals('', VFloat::init(15.1)->notBetween(15.2, 40)->message('Число'));
        $this->assertEquals('Значение Число не должно находиться в пределах между 14.3 и 30',
            VFloat::init(14.3)->notBetween(14.3, 30)->message('Число'));
    }

    public function testNotBetweenEq()
    {
        $this->assertEquals('', VFloat::init(15.1)->notBetweenEq(15.2, 40)->message('Число'));
        $this->assertEquals('Значение Число не должно находиться в пределах 14.1 и 30 включительно',
            VFloat::init(14.2)->notBetweenEq(14.1, 30)->message('Число'));
    }

    public function testNegative()
    {
        $this->assertEquals('', VFloat::init(-1.1)->negative()->message('Число'));
        $this->assertEquals('Значение Число должно быть меньше нуля',
            VFloat::init(0.0)->negative()->message('Число'));
    }

    public function testPositive()
    {
        $this->assertEquals('', VFloat::init(10.1)->positive()->message('Число'));
        $this->assertEquals('Значение Число должно быть больше нуля',
            VFloat::init(0.0)->positive()->message('Число'));
    }

    public function testIn()
    {
        $this->assertEquals('', VFloat::init(1.01)->in(100.1, 20.3, 1.01)->message('Число'));
        $this->assertEquals('Значение Число должно входить в список значений 100, 20, 20',
            VFloat::init(0.33)->in(100, 20, 20)->message('Число'));
    }

    public function testNotIn()
    {
        $this->assertEquals('', VFloat::init(1.01)->notIn(100.1, 20.3)->message('Число'));
        $this->assertEquals('Значение Число не должно входить в список значений 100, 20, 20, 1.01',
            VFloat::init(1.01)->notIn(100, 20, 20, 1.01)->message('Число'));
    }
}
<?php

namespace kradwhite\tests\unit;

use kradwhite\validation\VInt;

class VIntTest extends \Codeception\Test\Unit
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
        $this->assertEquals('', VInt::init(5)->between(1, 10)->message('Число'));
        $this->assertEquals('Значение Число не должно выходить за пределы между 5 и 10',
            VInt::init(5)->between(5, 10)->message('Число'));
    }

    public function testBetweenEq()
    {
        $this->assertEquals('', VInt::init(5)->betweenEq(5, 10)->message('Число'));
        $this->assertEquals('Значение Число не должно выходить за пределы между 6 и 10 включительно',
            VInt::init(5)->betweenEq(6, 10)->message('Число'));
    }

    public function testZero()
    {
        $this->assertEquals('', VInt::init(0)->zero()->message('Число'));
        $this->assertEquals('Значение Число должно равняться нулю',
            VInt::init(5)->zero()->message('Число'));
    }

    public function testEq()
    {
        $this->assertEquals('', VInt::init(10)->eq(10)->message('Число'));
        $this->assertEquals('Значение Число должно равняться 11',
            VInt::init(5)->eq(11)->message('Число'));
    }

    public function testHigher()
    {
        $this->assertEquals('', VInt::init(10)->higher(5)->message('Число'));
        $this->assertEquals('Значение Число должно быть больше, чем 5',
            VInt::init(5)->higher(5)->message('Число'));
    }

    public function testLower()
    {
        $this->assertEquals('', VInt::init(5)->lower(10)->message('Число'));
        $this->assertEquals('Значение Число должно быть меньше, чем 5',
            VInt::init(5)->lower(5)->message('Число'));
    }

    public function testHigherEq()
    {
        $this->assertEquals('', VInt::init(10)->higherEq(10)->message('Число'));
        $this->assertEquals('Значение Число должно быть больше или равным 10',
            VInt::init(5)->higherEq(10)->message('Число'));
    }

    public function testLowerEq()
    {
        $this->assertEquals('', VInt::init(5)->lowerEq(5)->message('Число'));
        $this->assertEquals('Значение Число должно быть меньше или равным 1',
            VInt::init(5)->lowerEq(1)->message('Число'));
    }

    public function testNotEq()
    {
        $this->assertEquals('', VInt::init(15)->notEq(5)->message('Число'));
        $this->assertEquals('Значение Число не должно равняться 5',
            VInt::init(5)->notEq(5)->message('Число'));
    }

    public function testNotZero()
    {
        $this->assertEquals('', VInt::init(15)->notZero()->message('Число'));
        $this->assertEquals('Значение Число не должно равняться нулю',
            VInt::init(0)->notZero()->message('Число'));
    }

    public function testNotBetween()
    {
        $this->assertEquals('', VInt::init(15)->notBetween(30, 40)->message('Число'));
        $this->assertEquals('Значение Число не должно находиться в пределах между 14 и 30',
            VInt::init(15)->notBetween(14, 30)->message('Число'));
    }

    public function testNotBetweenEq()
    {
        $this->assertEquals('', VInt::init(15)->notBetweenEq(30, 40)->message('Число'));
        $this->assertEquals('Значение Число не должно находиться в пределах 14 и 30 включительно',
            VInt::init(15)->notBetweenEq(14, 30)->message('Число'));
    }

    public function testNegative()
    {
        $this->assertEquals('', VInt::init(-1)->negative()->message('Число'));
        $this->assertEquals('Значение Число должно быть меньше нуля',
            VInt::init(0)->negative()->message('Число'));
    }

    public function testPositive()
    {
        $this->assertEquals('', VInt::init(10)->positive()->message('Число'));
        $this->assertEquals('Значение Число должно быть больше нуля',
            VInt::init(0)->positive()->message('Число'));
    }

    public function testIn()
    {
        $this->assertEquals('', VInt::init(10)->in(100, 20, 30, 10)->message('Число'));
        $this->assertEquals('Значение Число должно входить в список значений 100, 20, 10',
            VInt::init(0)->in(100, 20, 10)->message('Число'));
    }

    public function testNotIn()
    {
        $this->assertEquals('', VInt::init(10)->notIn(100, 20, 30)->message('Число'));
        $this->assertEquals('Значение Число не должно входить в спискок значений 100, 30, 20, 10',
            VInt::init(10)->notIn(100, 30, 20, 10)->message('Число'));
    }
}
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
        $this->assertTrue(VFloat::init(5.22)->between(5.21, 10.3)->check());
        $this->assertFalse(VFloat::init(5.33)->between(5.33, 10.3)->check());
    }

    public function testBetweenEq()
    {
        $this->assertTrue(VFloat::init(5.1)->betweenEq(5.1, 10.1)->check());
        $this->assertFalse(VFloat::init(6.3)->betweenEq(6.4, 10.1)->check());
    }

    public function testZero()
    {
        $this->assertTrue(VFloat::init(0)->zero()->check());
        $this->assertFalse(VFloat::init(5.3)->zero()->check());
    }

    public function testEq()
    {
        $this->assertTrue(VFloat::init(10.33)->eq(10.33)->check());
        $this->assertFalse(VFloat::init(11.32)->eq(11.33)->check());
    }

    public function testHigher()
    {
        $this->assertTrue(VFloat::init(10.23)->higher(10.22)->check());
        $this->assertFalse(VFloat::init(5.1)->higher(5.1)->check());
    }

    public function testLower()
    {
        $this->assertTrue(VFloat::init(5.2)->lower(5.3)->check());
        $this->assertFalse(VFloat::init(5.1)->lower(5.1)->check());
    }

    public function testHigherEq()
    {
        $this->assertTrue(VFloat::init(10.1)->higherEq(10.1)->check());
        $this->assertFalse(VFloat::init(10.2)->higherEq(10.3)->check());
    }

    public function testLowerEq()
    {
        $this->assertTrue(VFloat::init(5.1)->lowerEq(5.1)->check());
        $this->assertFalse(VFloat::init(5.2)->lowerEq(5.1)->check());
    }

    public function testNotEq()
    {
        $this->assertTrue(VFloat::init(5.1)->notEq(5.2)->check());
        $this->assertFalse(VFloat::init(5.1)->notEq(5.1)->check());
    }

    public function testNotZero()
    {
        $this->assertTrue(VFloat::init(15.1)->notZero()->check());
        $this->assertFalse(VFloat::init(0.0)->notZero()->check());
    }

    public function testNotBetween()
    {
        $this->assertTrue(VFloat::init(15.1)->notBetween(15.2, 40)->check());
        $this->assertFalse(VFloat::init(14.3)->notBetween(14.3, 30)->check());
    }

    public function testNotBetweenEq()
    {
        $this->assertTrue(VFloat::init(15.1)->notBetweenEq(15.2, 40)->check());
        $this->assertFalse(VFloat::init(14.2)->notBetweenEq(14.1, 30)->check());
    }

    public function testNegative()
    {
        $this->assertTrue(VFloat::init(-1.1)->negative()->check());
        $this->assertFalse(VFloat::init(0.0)->negative()->check());
    }

    public function testPositive()
    {
        $this->assertTrue(VFloat::init(10.1)->positive()->check());
        $this->assertFalse(VFloat::init(0.0)->positive()->check());
    }

    public function testIn()
    {
        $this->assertTrue(VFloat::init(1.01)->in(100.1, 20.3, 1.01)->check());
        $this->assertFalse(VFloat::init(0.33)->in(100, 20, 20)->check());
    }
}
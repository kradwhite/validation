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
        $this->assertTrue(VInt::init(5)->between(1, 10)->check());
        $this->assertFalse(VInt::init(5)->between(5, 10)->check());
    }

    public function testBetweenEq()
    {
        $this->assertTrue(VInt::init(5)->betweenEq(5, 10)->check());
        $this->assertFalse(VInt::init(5)->betweenEq(6, 10)->check());
    }

    public function testZero()
    {
        $this->assertTrue(VInt::init(0)->zero()->check());
        $this->assertFalse(VInt::init(5)->zero()->check());
    }

    public function testEq()
    {
        $this->assertTrue(VInt::init(10)->eq(10)->check());
        $this->assertFalse(VInt::init(5)->eq(11)->check());
    }

    public function testHigher()
    {
        $this->assertTrue(VInt::init(10)->higher(5)->check());
        $this->assertFalse(VInt::init(5)->higher(5)->check());
    }

    public function testLower()
    {
        $this->assertTrue(VInt::init(5)->lower(10)->check());
        $this->assertFalse(VInt::init(5)->lower(5)->check());
    }

    public function testHigherEq()
    {
        $this->assertTrue(VInt::init(10)->higherEq(10)->check());
        $this->assertFalse(VInt::init(5)->higherEq(10)->check());
    }

    public function testLowerEq()
    {
        $this->assertTrue(VInt::init(5)->lowerEq(5)->check());
        $this->assertFalse(VInt::init(5)->lowerEq(1)->check());
    }

    public function testNotEq()
    {
        $this->assertTrue(VInt::init(15)->notEq(5)->check());
        $this->assertFalse(VInt::init(5)->notEq(5)->check());
    }

    public function testNotZero()
    {
        $this->assertTrue(VInt::init(15)->notZero()->check());
        $this->assertFalse(VInt::init(0)->notZero()->check());
    }

    public function testNotBetween()
    {
        $this->assertTrue(VInt::init(15)->notBetween(30, 40)->check());
        $this->assertFalse(VInt::init(15)->notBetween(14, 30)->check());
    }

    public function testNotBetweenEq()
    {
        $this->assertTrue(VInt::init(15)->notBetweenEq(30, 40)->check());
        $this->assertFalse(VInt::init(15)->notBetweenEq(14, 30)->check());
    }

    public function testNegative()
    {
        $this->assertTrue(VInt::init(-1)->negative()->check());
        $this->assertFalse(VInt::init(0)->negative()->check());
    }

    public function testPositive()
    {
        $this->assertTrue(VInt::init(10)->positive()->check());
        $this->assertFalse(VInt::init(0)->positive()->check());
    }

    public function testIn()
    {
        $this->assertTrue(VInt::init(10)->in(100, 20, 30, 10)->check());
        $this->assertFalse(VInt::init(0)->in(100, 20, 20)->check());
    }

    public function testNotIn()
    {
        $this->assertTrue(VInt::init(10)->notIn(100, 20, 30)->check());
        $this->assertFalse(VInt::init(0)->in(100, 20, 20, 10)->check());
    }
}
<?php

namespace kradwhite\tests\unit;

use kradwhite\validation\VString;

class VStringTest extends \Codeception\Test\Unit
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
    public function testLonger()
    {
        $this->assertTrue(VString::init("string")->longer(5)->check());
        $this->assertFalse(VString::init("string")->longer(15)->check());
    }

    public function testShorter()
    {
        $this->assertTrue(VString::init("string")->shorter(15)->check());
        $this->assertFalse(VString::init("string")->shorter(5)->check());
    }

    public function testLongerEq()
    {
        $this->assertTrue(VString::init("string")->longerEq(6)->check());
        $this->assertFalse(VString::init("string")->longerEq(15)->check());
    }

    public function testShorterEq()
    {
        $this->assertTrue(VString::init("string")->shorterEq(6)->check());
        $this->assertFalse(VString::init("string")->shorterEq(2)->check());
    }

    public function testLength()
    {
        $this->assertTrue(VString::init("string")->length(6)->check());
        $this->assertFalse(VString::init("string")->length(2)->check());
    }

    public function testEquals()
    {
        $this->assertTrue(VString::init("string")->equals("string")->check());
        $this->assertFalse(VString::init("string")->equals("other string")->check());
    }

    public function testNotEquals()
    {
        $this->assertTrue(VString::init("string")->notEquals("other string")->check());
        $this->assertFalse(VString::init("string")->notEquals("string")->check());
    }

    public function testBetween()
    {
        $this->assertTrue(VString::init("string")->between(1, 7)->check());
        $this->assertFalse(VString::init("string")->between(1, 6)->check());
    }

    public function testBetweenEq()
    {
        $this->assertTrue(VString::init("string")->betweenEq(1, 6)->check());
        $this->assertFalse(VString::init("string")->betweenEq(1, 5)->check());
    }

    public function testNotBetween()
    {
        $this->assertTrue(VString::init("string")->notBetween(10, 73)->check());
        $this->assertFalse(VString::init("string")->notBetween(1, 7)->check());
    }

    public function testNotBetweenEq()
    {
        $this->assertTrue(VString::init("string")->notBetweenEq(7, 9)->check());
        $this->assertFalse(VString::init("string")->notBetweenEq(1, 7)->check());
    }

    public function testMatch()
    {
        VString::init("string")->match("/string/")->check();
        $this->assertFalse(VString::init("string")->match("/over string/")->check());
    }

    public function testContains()
    {
        $this->assertTrue(VString::init("string")->contains("st")->check());
        $this->assertFalse(VString::init("string")->contains("over")->check());
    }

    public function testNotContains()
    {
        $this->assertTrue(VString::init("string")->notContains("over")->check());
        $this->assertFalse(VString::init("string")->notContains("st")->check());
    }

    public function testDigits()
    {
        $this->assertTrue(VString::init("1234")->digits()->check());
        $this->assertFalse(VString::init("1string33")->digits()->check());
    }

    public function testNotDigits()
    {
        $this->assertTrue(VString::init("1string33")->notDigits()->check());
        $this->assertFalse(VString::init("1234")->notDigits()->check());
    }

    public function testAlpha()
    {
        $this->assertTrue(VString::init("stringSDF")->alpha()->check());
        $this->assertFalse(VString::init("1234")->alpha()->check());
    }

    public function testNotAlpha()
    {
        $this->assertTrue(VString::init("1234()$")->notAlpha()->check());
        $this->assertFalse(VString::init("strING")->notAlpha()->check());
    }

    public function testAlphaDigits()
    {
        $this->assertTrue(VString::init("stringSDF2343")->alphaDigits()->check());
        $this->assertFalse(VString::init("1234sdFD$#")->alphaDigits()->check());
    }

    public function testNotAlphaDigits()
    {
        $this->assertTrue(VString::init("1234()$")->notAlphaDigits()->check());
        $this->assertFalse(VString::init("strING2434")->notAlphaDigits()->check());
    }

    public function testPrefix()
    {
        $this->assertTrue(VString::init("prefix_string")->prefix("prefix")->check());
        $this->assertFalse(VString::init("prefix_string")->prefix("fix")->check());
    }

    public function testSuffix()
    {
        $this->assertTrue(VString::init("string_suffix")->suffix("suffix")->check());
        $this->assertFalse(VString::init("string_suffix")->suffix("suf")->check());
    }

    public function testIn()
    {
        $this->assertTrue(VString::init('str')->in('str2', 'str3', 'str')->check());
        $this->assertFalse(VString::init('str')->in('str1', 'str3')->check());
    }
}
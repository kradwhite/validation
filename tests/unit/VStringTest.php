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
        $this->assertEquals('', VString::init("string")->longer(5)->message('строка'));
        $this->assertEquals('Длина строка должна быть минимум 15',
            VString::init("string")->longer(15)->message('строка'));
    }

    public function testShorter()
    {
        $this->assertEquals('', VString::init("string")->shorter(15)->message('строка'));
        $this->assertEquals('Длина строка должна быть максимум 5',
            VString::init("string")->shorter(5)->message('строка'));
    }

    public function testLongerEq()
    {
        $this->assertEquals('', VString::init("string")->longerEq(6)->message('строка'));
        $this->assertEquals('Длина строка должна быть минимум или равно 15',
            VString::init("string")->longerEq(15)->message('строка'));
    }

    public function testShorterEq()
    {
        $this->assertEquals('', VString::init("string")->shorterEq(6)->message('строка'));
        $this->assertEquals('Длина строка должна быть минимум или равна 2',
            VString::init("string")->shorterEq(2)->message('строка'));
    }

    public function testLength()
    {
        $this->assertEquals('', VString::init("string")->length(6)->message('строка'));
        $this->assertEquals('Длина строка должна равняться 2',
            VString::init("string")->length(2)->message('строка'));
    }

    public function testEquals()
    {
        $this->assertEquals('', VString::init("string")->equals("string")->message('строка'));
        $this->assertEquals('Значение строка должно соответствовать other string',
            VString::init("string")->equals("other string")->message('строка'));
    }

    public function testNotEquals()
    {
        $this->assertEquals('', VString::init("string")->notEquals("other string")->message('строка'));
        $this->assertEquals('Значение строка не должно соответствовать string',
            VString::init("string")->notEquals("string")->message('строка'));
    }

    public function testBetween()
    {
        $this->assertEquals('', VString::init("string")->between(1, 7)->message('строка'));
        $this->assertEquals('Длина строка не должна выходить за пределы между 1 и 6',
            VString::init("string")->between(1, 6)->message('строка'));
    }

    public function testBetweenEq()
    {
        $this->assertEquals('', VString::init("string")->betweenEq(1, 6)->message('строка'));
        $this->assertEquals('Длина строка не должна выходить за пределы между 1 и 5 включительно',
            VString::init("string")->betweenEq(1, 5)->message('строка'));
    }

    public function testNotBetween()
    {
        $this->assertEquals('', VString::init("string")->notBetween(10, 73)->message('строка'));
        $this->assertEquals('Длина строка должна выходить за пределы между 1 и 7',
            VString::init("string")->notBetween(1, 7)->message('строка'));
    }

    public function testNotBetweenEq()
    {
        $this->assertEquals('', VString::init("string")->notBetweenEq(7, 9)->message('строка'));
        $this->assertEquals('Длина строка должна выходить за пределы между 1 и 7 включительно',
            VString::init("string")->notBetweenEq(1, 7)->message('строка'));
    }

    public function testMatch()
    {
        $this->assertEquals('', VString::init("string")->match("/string/")->message('строка'));
        $this->assertEquals('Значение строка не соответсвтует /over string/',
            VString::init("string")->match("/over string/")->message('строка'));
    }

    public function testContains()
    {
        $this->assertEquals('', VString::init("string")->contains("st")->message('строка'));
        $this->assertEquals('Значение строка не должно содержать over',
            VString::init("string")->contains("over")->message('строка'));
    }

    public function testNotContains()
    {
        $this->assertEquals('', VString::init("string")->notContains("over")->message('строка'));
        $this->assertEquals('Значение строка должно содержать st',
            VString::init("string")->notContains("st")->message('строка'));
    }

    public function testDigits()
    {
        $this->assertEquals('', VString::init("1234")->digits()->message('строка'));
        $this->assertEquals('Значение строка должно состоять только из цифр',
            VString::init("1string33")->digits()->message('строка'));
    }

    public function testNotDigits()
    {
        $this->assertEquals('', VString::init("1string33")->notDigits()->message('строка'));
        $this->assertEquals('Значение строка должно состоять не только из цифр',
            VString::init("1234")->notDigits()->message('строка'));
    }

    public function testAlpha()
    {
        $this->assertEquals('', VString::init("stringSDF")->alpha()->message('строка'));
        $this->assertEquals('Значение строка должно состоять только из символов алфавита',
            VString::init("1234")->alpha()->message('строка'));
    }

    public function testNotAlpha()
    {
        $this->assertEquals('', VString::init("1234()$")->notAlpha()->message('строка'));
        $this->assertEquals('Значение строка должно состоять не только из символов алфавита',
            VString::init("strING")->notAlpha()->message('строка'));
    }

    public function testAlphaDigits()
    {
        $this->assertEquals('', VString::init("stringSDF2343")->alphaDigits()->message('строка'));
        $this->assertEquals('Значение строка должно состоять только из символов алфавита и цифр',
            VString::init("1234sdFD$#")->alphaDigits()->message('строка'));
    }

    public function testNotAlphaDigits()
    {
        $this->assertEquals('', VString::init("1234()$")->notAlphaDigits()->message('строка'));
        $this->assertEquals('Значение строка должно состоять не только из символов алфавита и цифр',
            VString::init("strING2434")->notAlphaDigits()->message('строка'));
    }

    public function testPrefix()
    {
        $this->assertEquals('', VString::init("prefix_string")->prefix("prefix")->message('строка'));
        $this->assertEquals('Начало строка должно соответствовать fix',
            VString::init("prefix_string")->prefix("fix")->message('строка'));
    }

    public function testSuffix()
    {
        $this->assertEquals('', VString::init("string_suffix")->suffix("suffix")->message('строка'));
        $this->assertEquals('Конец строка не должен соответствовать suf',
            VString::init("string_suffix")->suffix("suf")->message('строка'));
    }

    public function testIn()
    {
        $this->assertEquals('', VString::init('str')->in('str2', 'str3', 'str')->message('строка'));
        $this->assertEquals('Значение строка должно входить в список значений [str1, str3]',
            VString::init('str')->in('str1', 'str3')->message('строка'));
    }

    public function testNotIn()
    {
        $this->assertEquals('', VString::init('str')->notIn('str2', 'str3')->message('строка'));
        $this->assertEquals('Значение строка не должно входить в список значений [str1, str3, str]',
            VString::init('str')->notIn('str1', 'str3', 'str')->message('строка'));
    }
}
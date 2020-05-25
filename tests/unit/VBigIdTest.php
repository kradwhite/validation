<?php

namespace kradwhite\tests\unit;

use kradwhite\validation\VBigId;

class VBigIdTest extends \Codeception\Test\Unit
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

    public function testCheck()
    {
        $this->assertEquals('', VBigId::init(3434)->message('Идентификатор'));
        $this->assertEquals('Значение Идентификатор должно быть больше 0 и меньше или равен ' . PHP_INT_MAX,
            VBigId::init(-11)->message('Идентификатор'));
    }
}
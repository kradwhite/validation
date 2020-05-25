<?php

namespace kradwhite\tests\unit;

use kradwhite\validation\VId;

class VIdTest extends \Codeception\Test\Unit
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
    public function testCheck()
    {
        $this->assertEquals('', VId::init(3434)->message('Идентификатор'));
        $this->assertEquals('Значение Идентификатор должно быть больше 0 и меньше или равен 2147483647',
            VId::init(-11)->message('Идентификатор'));
        $this->assertEquals('Значение Идентификатор должно быть больше 0 и меньше или равен 2147483647',
            VId::init(VId::Max + 1)->message('Идентификатор'));
    }
}
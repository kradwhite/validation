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
        $this->assertTrue(VBigId::check(3434));
        $this->assertFalse(VBigId::check(-11));
    }
}
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
        $this->assertTrue(VId::check(3434));
        $this->assertFalse(VId::check(-11));
        $this->assertFalse(VId::check(2147483647 + 1));
    }
}
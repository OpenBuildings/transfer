<?php

namespace Harp\Transfer\Test;

use Harp\Transfer\AssertCurrency;
use Harp\Validate\Error;
use stdClass;

/**
 * @coversDefaultClass Harp\Transfer\AssertCurrency
 */
class AssertCurrencyTest extends AbstractTestCase
{
    public function dataExecute()
    {
        return array(
            array('BGN', true),
            array('GBP', true),
            array('G31', 'test is invalid'),
            array('1', 'test is invalid'),
        );
    }

    /**
     * @dataProvider dataExecute
     * @covers ::execute
     */
    public function testExecute($value, $expected)
    {
        $assertion = new AssertCurrency('test');

        $this->assertAssertion($expected, $assertion, $value);
    }

    public function assertAssertion($expected, AssertCurrency $assertion, $value)
    {
        if (is_array($value)) {
            $object = $value;
        } else {
            $object = new stdClass();
            $object->{$assertion->getName()} = $value;
        }

        $result = $assertion->execute($object);

        if ($expected === true) {
            $message = sprintf('Assertion %s should pass', get_class($assertion));
            $this->assertTrue(is_null($result), $message);
        } else {
            $message = sprintf('Assertion %s should fail', get_class($assertion));

            $this->assertTrue($result instanceof Error, $message);
            $this->assertEquals($expected, $result->getFullMessage());
        }
    }
}

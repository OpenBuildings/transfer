<?php

namespace CL\Transfer\Test;

use SebastianBergmann\Money\Money;
use SebastianBergmann\Money\Currency;

/**
 * @coversDefaultClass CL\Transfer\ItemTrait
 *
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class ItemTraitTest extends AbstractTestCase
{
    /**
     * @covers ::initialize
     */
    public function testInitialize()
    {
        $repo = ProductItem::getRepo();

        $this->assertTrue($repo->getSoftDelete());
    }

    /**
     * @coversNothing
     */
    public function testAsserts()
    {
        $item = new ProductItem(['quantity' => -12]);

        $item->validate();

        $this->assertEquals(
            'quantity should be greater than 0',
            $item->getErrors()->humanize()
        );

        $item = new ProductItem(['quantity' => null]);

        $item->validate();

        $this->assertEquals(
            'quantity must be present',
            $item->getErrors()->humanize()
        );

        $item = new ProductItem(['quantity' => 'asd123']);

        $item->validate();

        $this->assertEquals(
            'quantity is an invalid number, quantity should be greater than 0',
            $item->getErrors()->humanize()
        );
    }

    /**
     * @covers ::getName
     * @covers ::getDescription
     */
    public function testGetName()
    {
        $item = new ProductItem(['id' => 1232]);

        $this->assertSame('Item', $item->getDescription());
        $this->assertSame(1232, $item->getName());
    }

    /**
     * @covers ::getTotalValue
     */
    public function testGetTotalValue()
    {
        $item = $this->getMock(__NAMESPACE__.'\ProductItem', ['getValue'], [['quantity' => 5]]);

        $item
            ->expects($this->once())
            ->method('getValue')
            ->will($this->returnValue(new Money(1000, new Currency('EUR'))));

        $this->assertEquals(new Money(5000, new Currency('EUR')), $item->getTotalValue());
    }
}

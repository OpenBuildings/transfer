<?php

namespace Harp\Transfer\Test\Model;

use Harp\Transfer\Test\Repo;
use Harp\Transfer\Test\AbstractTestCase;
use SebastianBergmann\Money\Money;
use SebastianBergmann\Money\Currency;

/**
 * @coversDefaultClass Harp\Transfer\Model\AbstractItem
 *
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class AbstractItemTest extends AbstractTestCase
{
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

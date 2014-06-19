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
     */
    public function testGetName()
    {
        $item = new ProductItem();

        $this->assertSame('Item', $item->getName());
    }

    /**
     * @covers ::getPrice
     */
    public function testGetPrice()
    {
        $item = $this->getMock(__NAMESPACE__.'\ProductItem', ['getCurrency', 'getRefPrice']);

        $item
            ->expects($this->exactly(3))
            ->method('getCurrency')
            ->will($this->returnValue(new Currency('EUR')));

        $item
            ->expects($this->exactly(2))
            ->method('getRefPrice')
            ->will(
                $this->onConsecutiveCalls(
                    new Money(1000, new Currency('GBP')),
                    new Money(2000, new Currency('BGN'))
                )
            );

        $this->assertEquals(new Money(1000, new Currency('EUR')), $item->getPrice());

        $this->assertEquals(new Money(2000, new Currency('EUR')), $item->getPrice());

        $item->isFrozen = true;
        $item->price = 100;

        $this->assertEquals(new Money(100, new Currency('EUR')), $item->getPrice());
    }

    /**
     * @covers ::freeze
     */
    public function testFreeze()
    {
        $item = $this->getMock(__NAMESPACE__.'\ProductItem', ['getPrice']);

        $item
            ->expects($this->once())
            ->method('getPrice')
            ->will($this->returnValue(new Money(1000, new Currency('EUR'))));

        $item->freeze();
        $item->freeze();

        $this->assertTrue($item->isFrozen);
        $this->assertEquals(1000, $item->price);
    }

    /**
     * @covers ::unfreeze
     */
    public function testUnfreeze()
    {
        $item = new ProductItem(['price' => 1000, 'isFrozen' => true]);

        $item->unfreeze();
        $item->unfreeze();

        $this->assertFalse($item->isFrozen);
        $this->assertNull($item->price);
    }

    /**
     * @covers ::setPrice
     */
    public function testSetPrice()
    {
        $item = new ProductItem(['price' => 1000]);

        $item->setPrice(new Money(5000, new Currency('EUR')));

        $this->assertEquals(5000, $item->price);
    }

    /**
     * @covers ::getTotalPrice
     */
    public function testGetTotalPrice()
    {
        $item = $this->getMock(__NAMESPACE__.'\ProductItem', ['getPrice'], [['quantity' => 5]]);

        $item
            ->expects($this->once())
            ->method('getPrice')
            ->will($this->returnValue(new Money(1000, new Currency('EUR'))));

        $this->assertEquals(new Money(5000, new Currency('EUR')), $item->getTotalPrice());
    }
}

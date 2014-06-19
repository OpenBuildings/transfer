<?php

namespace Harp\Transfer\Test\Model;

use Harp\Transfer\Test\Repo;
use Harp\Transfer\Test\AbstractTestCase;
use SebastianBergmann\Money\Money;
use SebastianBergmann\Money\Currency;
use DateTime;

/**
 * @coversDefaultClass Harp\Transfer\Model\AbstractItemGroup
 *
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class AbstractItemGroupTest extends AbstractTestCase
{
    /**
     * @covers ::getAmount
     */
    public function testGetAmount()
    {
        $basket = new Basket(['amount' => 3200, 'currency' => 'BGN']);

        $this->assertEquals(new Money(3200, new Currency('BGN')), $basket->getAmount());
    }

    /**
     * @covers ::getCurrency
     */
    public function testGetCurrency()
    {
        $basket = new Basket(['currency' => 'BGN']);

        $this->assertEquals(new Currency('BGN'), $basket->getCurrency());
    }

    /**
     * @covers ::getTotal
     */
    public function testGetTotal()
    {
        $basket = new Basket(['currency' => 'BGN']);
        $basket
            ->getItems()
                ->add(new ProductItem(['price' => 1000, 'isFrozen' => true, 'quantity' => 2]))
                ->add(new ProductItem(['price' => 2000, 'isFrozen' => true, 'quantity' => 3]));

        $this->assertEquals(new Money(8000, new Currency('BGN')), $basket->getTotal());
    }

    /**
     * @covers ::freeze
     */
    public function testFreeze()
    {
        $basket = new Basket(['currency' => 'BGN']);

        $item1 = $this->getMock(__NAMESPACE__.'\ProductItem', ['freeze']);
        $item1
            ->expects($this->once())
            ->method('freeze');

        $item2 = $this->getMock(__NAMESPACE__.'\ProductItem', ['freeze']);
        $item2
            ->expects($this->once())
            ->method('freeze');

        $basket
            ->getItems()
                ->add($item1)
                ->add($item2);

        $basket->freeze();
    }

    /**
     * @covers ::unfreeze
     */
    public function testUnfreeze()
    {
        $basket = new Basket(['currency' => 'BGN']);

        $item1 = $this->getMock(__NAMESPACE__.'\ProductItem', ['unfreeze']);
        $item1
            ->expects($this->once())
            ->method('unfreeze');

        $item2 = $this->getMock(__NAMESPACE__.'\ProductItem', ['unfreeze']);
        $item2
            ->expects($this->once())
            ->method('unfreeze');

        $basket
            ->getItems()
                ->add($item1)
                ->add($item2);

        $basket->unfreeze();
    }
}

<?php

namespace CL\Transfer\Test;

use SebastianBergmann\Money\Money;
use SebastianBergmann\Money\Currency;
use DateTime;

/**
 * @coversDefaultClass CL\Transfer\AbstractItemGroup
 *
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class AbstractItemGroupTest extends AbstractTestCase
{
    /**
     * @covers ::getSourceValue
     */
    public function testGetSourceValue()
    {
        $basket = new Basket(['currency' => 'BGN']);
        $basket
            ->getItems()
                ->add(new ProductItem(['value' => 1000, 'isFrozen' => true, 'quantity' => 2]))
                ->add(new ProductItem(['value' => 2000, 'isFrozen' => true, 'quantity' => 3]));

        $this->assertEquals(new Money(8000, new Currency('BGN')), $basket->getSourceValue());
    }

    /**
     * @covers ::performFreeze
     */
    public function testPerformFreeze()
    {
        $basket = new Basket(['currency' => 'BGN']);

        $item1 = $this->getMock(
            __NAMESPACE__.'\ProductItem',
            ['freeze'],
            [['value' => 1000, 'isFrozen' => true, 'quantity' => 2]]
        );

        $item1
            ->expects($this->once())
            ->method('freeze');

        $item2 = $this->getMock(
            __NAMESPACE__.'\ProductItem',
            ['freeze'],
            [['value' => 2000, 'isFrozen' => true, 'quantity' => 3]]
        );

        $item2
            ->expects($this->once())
            ->method('freeze');

        $basket
            ->getItems()
                ->add($item1)
                ->add($item2);

        $basket->freeze();

        $this->assertEquals(8000, $basket->value);
    }

    /**
     * @covers ::performUnfreeze
     */
    public function testUnfreeze()
    {
        $basket = new Basket(['currency' => 'BGN', 'value' => 2000, 'isFrozen' => true]);

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

        $this->assertEquals(0, $basket->value);
    }
}

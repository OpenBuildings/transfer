<?php

namespace CL\Transfer\Test\Repo;

use CL\Transfer\Test\Model;
use CL\Transfer\Test\AbstractTestCase;

/**
 * @coversDefaultClass CL\Transfer\Repo\AbstractItem
 *
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class AbstractItemTest extends AbstractTestCase
{
    /**
     * @covers ::initialize
     */
    public function testInitialize()
    {
        $repo = ProductItem::newInstance();

        $this->assertTrue($repo->getSoftDelete());
    }

    /**
     * @coversNothing
     */
    public function testAsserts()
    {
        $item = new Model\ProductItem(['quantity' => -12]);

        $item->validate();

        $this->assertEquals(
            'quantity should be greater than 0',
            $item->getErrors()->humanize()
        );

        $item = new Model\ProductItem(['quantity' => null]);

        $item->validate();

        $this->assertEquals(
            'quantity must be present',
            $item->getErrors()->humanize()
        );

        $item = new Model\ProductItem(['quantity' => 'asd123']);

        $item->validate();

        $this->assertEquals(
            'quantity is an invalid number, quantity should be greater than 0',
            $item->getErrors()->humanize()
        );
    }
}

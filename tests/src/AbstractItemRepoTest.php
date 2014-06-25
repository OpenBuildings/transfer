<?php

namespace CL\Transfer\Test;

/**
 * @coversDefaultClass CL\Transfer\AbstractItemRepo
 *
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class AbstractItemRepoTest extends AbstractTestCase
{
    /**
     * @covers ::initialize
     */
    public function testInitialize()
    {
        $repo = new ProductItemRepo();

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
}

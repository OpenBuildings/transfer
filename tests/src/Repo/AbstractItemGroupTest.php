<?php

namespace Harp\Transfer\Test\Repo;

use Harp\Transfer\Test\Model;
use Harp\Transfer\Test\AbstractTestCase;

/**
 * @coversDefaultClass Harp\Transfer\Repo\AbstractItemGroup
 *
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class AbstractItemGroupTest extends AbstractTestCase
{
    /**
     * @covers ::initialize
     */
    public function testInitialize()
    {
        $repo = new Basket('Harp\Transfer\Test\Model\Basket');

        $this->assertTrue($repo->getSoftDelete());
    }

    /**
     * @coversNothing
     */
    public function testAsserts()
    {
        $item = new Model\Basket(['amount' => 'aaa']);

        $item->validate();

        $this->assertEquals(
            'amount is an invalid number',
            $item->getErrors()->humanize()
        );

        $item = new Model\Basket(['currency' => 'aaa']);

        $item->validate();

        $this->assertEquals(
            'currency is invalid',
            $item->getErrors()->humanize()
        );
    }
}

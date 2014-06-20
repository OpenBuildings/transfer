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
        $repo = Basket::newInstance();

        $this->assertTrue($repo->getSoftDelete());
    }
}

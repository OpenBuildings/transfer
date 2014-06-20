<?php

namespace CL\Transfer\Test\Repo;

use CL\Transfer\Test\Model;
use CL\Transfer\Test\AbstractTestCase;

/**
 * @coversDefaultClass CL\Transfer\Repo\AbstractItemGroup
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

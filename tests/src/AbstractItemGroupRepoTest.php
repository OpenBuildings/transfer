<?php

namespace CL\Transfer\Test;

/**
 * @coversDefaultClass CL\Transfer\AbstractItemGroupRepo
 *
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class AbstractItemGroupRepoTest extends AbstractTestCase
{
    /**
     * @covers ::initialize
     */
    public function testInitialize()
    {
        $repo = new BasketRepo();

        $this->assertTrue($repo->getSoftDelete());
    }
}

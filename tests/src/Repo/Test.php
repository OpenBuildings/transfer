<?php

namespace Harp\Transfer\Test\Repo;

use Harp\Harp\AbstractRepo;
use Harp\Transfer\Test\Model;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Test extends AbstractRepo
{
    /**
     * @return Test
     */
    public static function newInstance()
    {
        return new Test('Harp\Transfer\Test\Model\Test');
    }

    public function initialize()
    {

    }
}

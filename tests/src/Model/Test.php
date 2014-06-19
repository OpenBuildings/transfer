<?php

namespace Harp\Transfer\Test\Model;

use Harp\Harp\AbstractModel;
use Harp\Transfer\Test\Repo;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Test extends AbstractModel
{
    /**
     * @return Repo\Test
     */
    public function getRepo()
    {
        return Repo\Test::get();
    }

    public $id;
    public $name;
    public $isTest = false;
    public $testId;
    public $testClass;
    public $deletedAt;
}

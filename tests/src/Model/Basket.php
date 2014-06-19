<?php

namespace Harp\Transfer\Test\Model;

use Harp\Harp\AbstractModel;
use Harp\Transfer\Model\AbstractTransfer;
use Harp\Transfer\Test\Repo;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Basket extends AbstractTransfer
{
    public function getRepo()
    {
        return Repo\Basket::get();
    }

    public function getItems()
    {
        return $this->getLink('items');
    }
}

<?php

namespace Harp\Transfer\Test\Model;

use Harp\Harp\AbstractModel;
use Harp\Transfer\Test\Repo;
use Harp\Money\Model\ValueTrait;
use Harp\Money\Model\CurrencyTrait;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Product extends AbstractModel
{
    use ValueTrait;
    use CurrencyTrait;

    public $id;
    public $name;

    public function getRepo()
    {
        return Repo\Product::get();
    }
}

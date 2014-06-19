<?php

namespace Harp\Transfer\Test\Model;

use Harp\Harp\AbstractModel;
use Harp\Transfer\Model\AbstractTransfer;
use Harp\Transfer\Test\Repo;
use SebastianBergmann\Money\Money;
use SebastianBergmann\Money\Currency;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Product extends AbstractModel
{
    public $id;
    public $name;
    public $price = 0;
    public $currency = 'GBP';

    public function getRepo()
    {
        return Repo\Product::get();
    }

    public function getCurrency()
    {
        return new Currency($this->currency);
    }

    public function getPrice()
    {
        return new Money($this->price, $this->getCurrency());
    }
}

<?php

namespace CL\Transfer\Test\Repo;

use Harp\Harp\AbstractRepo;
use Harp\Validate\Assert;
use CL\Transfer\AssertCurrency;
use Harp\Money\Repo\ValueTrait;
use Harp\Money\Repo\CurrencyTrait;


/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Product extends AbstractRepo
{
    use ValueTrait;
    use CurrencyTrait;

    public static function newInstance()
    {
        return new Product('CL\Transfer\Test\Model\Product');
    }

    public function initialize()
    {
        $this
            ->initializeValue()
            ->initializeCurrency();
    }
}

<?php

namespace CL\Transfer\Test;

use Harp\Harp\AbstractRepo;
use Harp\Validate\Assert;
use CL\Transfer\AssertCurrency;
use Harp\Money\ValueRepoTrait;
use Harp\Money\CurrencyRepoTrait;


/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class ProductRepo extends AbstractRepo
{
    use ValueRepoTrait;
    use CurrencyRepoTrait;

    public function initialize()
    {
        $this
            ->setModelClass('CL\Transfer\Test\Product')
            ->initializeValue()
            ->initializeCurrency();
    }
}

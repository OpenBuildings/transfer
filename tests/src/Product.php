<?php

namespace CL\Transfer\Test;

use Harp\Harp\AbstractModel;
use Harp\Money\ValueTrait;
use Harp\Money\CurrencyTrait;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Product extends AbstractModel
{
    const REPO = 'CL\Transfer\Test\ProductRepo';

    use ValueTrait;
    use CurrencyTrait;

    public $id;
    public $name;
}

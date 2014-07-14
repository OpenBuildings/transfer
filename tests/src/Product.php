<?php

namespace CL\Transfer\Test;

use Harp\Harp\AbstractModel;
use Harp\Harp\Config;
use Harp\Money\ValueTrait;
use Harp\Money\CurrencyTrait;


/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Product extends AbstractModel
{
    use ValueTrait;
    use CurrencyTrait;

    public static function initialize(Config $config)
    {
        ValueTrait::initialize($config);
        CurrencyTrait::initialize($config);
    }

    public $id;
    public $name;
}

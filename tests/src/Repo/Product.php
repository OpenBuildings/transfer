<?php

namespace Harp\Transfer\Test\Repo;

use Harp\Harp\AbstractRepo;
use Harp\Validate\Assert;
use Harp\Transfer\AssertCurrency;
use Harp\Harp\Rel;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Product extends AbstractRepo
{
    public static function newInstance()
    {
        return new Product('Harp\Transfer\Test\Model\Product');
    }

    public function initialize()
    {
        $this
            ->addAsserts([
                new Assert\Present('currency'),
                new Assert\AssertCurrency('currency'),
                new Assert\Number('price'),
                new Assert\LengthEquals('currency', 3),
            ]);
    }
}

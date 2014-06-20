<?php

namespace Harp\Transfer\Test\Repo;

use Harp\Transfer\Repo\AbstractItem;
use Harp\Harp\Rel;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class ProductItem extends AbstractItem
{
    public static function newInstance()
    {
        return new ProductItem('Harp\Transfer\Test\Model\ProductItem');
    }

    public function initialize()
    {
        parent::initialize();

        $this
            ->setTable('Item')
            ->addRels([
                new Rel\BelongsTo('basket', $this, Basket::get(), ['key' => 'transferId']),
                new Rel\BelongsTo('product', $this, Product::get(), ['key' => 'refId']),
            ]);

    }
}

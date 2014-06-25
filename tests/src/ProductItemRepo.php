<?php

namespace CL\Transfer\Test;

use CL\Transfer\AbstractItemRepo;
use Harp\Harp\Rel;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class ProductItemRepo extends AbstractItemRepo
{
    public function initialize()
    {
        parent::initialize();

        $this
            ->setModelClass('CL\Transfer\Test\ProductItem')
            ->setTable('Item')
            ->addRels([
                new Rel\BelongsTo('basket', $this, BasketRepo::get(), ['key' => 'transferId']),
                new Rel\BelongsTo('product', $this, ProductRepo::get(), ['key' => 'refId']),
            ]);

    }
}

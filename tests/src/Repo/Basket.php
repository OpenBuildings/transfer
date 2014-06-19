<?php

namespace Harp\Transfer\Test\Repo;

use Harp\Transfer\Repo\AbstractTransfer;
use Harp\Harp\Rel;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Basket extends AbstractTransfer
{
    public static function newInstance()
    {
        return new Basket('Harp\Transfer\Test\Model\Basket');
    }

    public function initialize()
    {
        parent::initialize();

        $this
            ->addRels([
                new Rel\HasMany('items', $this, ProductItem::get(), ['foreignKey' => 'transferId']),
            ]);
    }
}

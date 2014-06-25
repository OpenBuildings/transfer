<?php

namespace CL\Transfer\Test;

use CL\Transfer\AbstractTransferRepo;
use Harp\Money\CurrencyRepoTrait;
use Harp\Harp\Rel;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class BasketRepo extends AbstractTransferRepo
{
    use CurrencyRepoTrait;

    public function initialize()
    {
        parent::initialize();

        $this
            ->setModelClass('CL\Transfer\Test\Basket')
            ->initializeCurrency()
            ->addRels([
                new Rel\HasMany('items', $this, ProductItemRepo::get(), ['foreignKey' => 'transferId']),
            ]);
    }
}

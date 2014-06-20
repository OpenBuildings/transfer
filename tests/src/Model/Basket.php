<?php

namespace CL\Transfer\Test\Model;

use CL\Transfer\Model\AbstractTransfer;
use Harp\Money\Model\CurrencyTrait;
use CL\Transfer\Test\Repo;
use Omnipay\Common\GatewayInterface;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Basket extends AbstractTransfer
{
    use CurrencyTrait;

    public function getRepo()
    {
        return Repo\Basket::get();
    }

    public function getItems()
    {
        return $this->getLink('items');
    }

    public function purchase(GatewayInterface $gateway, array $parameters)
    {
        return parent::execute($gateway, 'purchase', $parameters);
    }
}

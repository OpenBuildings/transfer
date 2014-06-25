<?php

namespace CL\Transfer\Test;

use CL\Transfer\AbstractTransfer;
use Harp\Money\CurrencyTrait;
use Omnipay\Common\GatewayInterface;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Basket extends AbstractTransfer
{
    const REPO = 'CL\Transfer\Test\BasketRepo';

    use CurrencyTrait;

    public function getItems()
    {
        return $this->getLink('items');
    }

    public function purchase(GatewayInterface $gateway, array $parameters)
    {
        return parent::execute($gateway, 'purchase', $parameters);
    }
}

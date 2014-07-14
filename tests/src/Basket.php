<?php

namespace CL\Transfer\Test;

use CL\Transfer\AbstractTransfer;
use Harp\Money\CurrencyTrait;
use Omnipay\Common\GatewayInterface;
use Harp\Harp\Rel;
use Harp\Harp\Config;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Basket extends AbstractTransfer
{
    use CurrencyTrait;

    public static function initialize(Config $config)
    {
        parent::initialize($config);

        CurrencyTrait::initialize($config);

        $config
            ->setTable('Basket')
            ->addRels([
                new Rel\HasMany('items', $config, ProductItem::getRepo(), ['foreignKey' => 'transferId']),
            ]);
    }

    public function getItems()
    {
        return $this->all('items');
    }

    public function purchase(GatewayInterface $gateway, array $parameters)
    {
        return parent::execute($gateway, 'purchase', $parameters);
    }
}

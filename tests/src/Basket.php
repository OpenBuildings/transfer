<?php

namespace CL\Transfer\Test;

use Harp\Harp\AbstractModel;
use CL\Transfer\TransferTrait;
use Harp\Money\CurrencyTrait;
use Omnipay\Common\GatewayInterface;
use Harp\Harp\Rel;
use Harp\Harp\Config;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Basket extends AbstractModel
{
    use CurrencyTrait;
    use TransferTrait;

    public static function initialize(Config $config)
    {
        TransferTrait::initialize($config);
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
        return $this->execute($gateway, 'purchase', $parameters);
    }
}

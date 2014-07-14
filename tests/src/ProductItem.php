<?php

namespace CL\Transfer\Test;

use CL\Transfer\AbstractItem;
use Harp\Harp\Config;
use Harp\Harp\Rel;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class ProductItem extends AbstractItem
{
    public static function initialize(Config $config)
    {
        parent::initialize($config);

        $config
            ->setTable('Item')
            ->addRels([
                new Rel\BelongsTo('basket', $config, Basket::getRepo(), ['key' => 'transferId']),
                new Rel\BelongsTo('product', $config, Product::getRepo(), ['key' => 'refId']),
            ]);
    }

    public function getProduct()
    {
        return $this->get('product');
    }

    public function setProduct(Product $product)
    {
        return $this->set('product', $product);
    }

    public function getBasket()
    {
        return $this->get('basket');
    }

    public function setBasket(Basket $basket)
    {
        return $this->set('basket', $basket);
    }

    public function getCurrency()
    {
        return $this->getBasket()->getCurrency();
    }

    public function getSourceValue()
    {
        return $this->getProduct()->getValue();
    }
}

<?php

namespace CL\Transfer\Test;

use CL\Transfer\ItemTrait;
use Harp\Harp\Config;
use Harp\Harp\AbstractModel;
use Harp\Harp\Rel;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class ProductItem extends AbstractModel
{
    use ItemTrait;

    public static function initialize(Config $config)
    {
        ItemTrait::initialize($config);

        $config
            ->addRels([
                new Rel\BelongsTo('basket', $config, Basket::getRepo()),
                new Rel\BelongsTo('product', $config, Product::getRepo()),
            ]);
    }

    public $id;
    public $basketId;
    public $productId;

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

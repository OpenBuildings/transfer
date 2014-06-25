<?php

namespace CL\Transfer\Test;

use CL\Transfer\AbstractItem;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class ProductItem extends AbstractItem
{
    const REPO = 'CL\Transfer\Test\ProductItemRepo';

    public function getProduct()
    {
        return $this->getLink('product')->get();
    }

    public function setProduct(Product $product)
    {
        return $this->getLink('product')->set($product);
    }

    public function getBasket()
    {
        return $this->getLink('basket')->get();
    }

    public function setBasket(Basket $basket)
    {
        return $this->getLink('basket')->set($basket);
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

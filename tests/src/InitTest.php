<?php

namespace Harp\Transfer\Test;

use Harp\Transfer\Test\Repo;
use Harp\Transfer\Test\Model;
use Omnipay\Omnipay;

/**
 * @coversDefaultClass Harp\Transfer\Init
 *
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class InitTest extends AbstractTestCase
{
    /**
     * @covers ::testMethod
     */
    public function testTest()
    {
        $basket = new Model\Basket();
        $product1 = Repo\Product::get()->find(1);
        $product2 = Repo\Product::get()->find(2);

        $item1 = new Model\ProductItem(['quantity' => 2]);
        $item1->setProduct($product1);

        $item2 = new Model\ProductItem(['quantity' => 4]);
        $item2->setProduct($product2);

        $basket->getItems()
            ->add($item1)
            ->add($item2);

        Repo\Basket::get()->save($basket);

        $gateway = Omnipay::getFactory()->create('Dummy');

        $parameters = [
            'card' => [
                'number' => '4242424242424242',
                'expiryMonth' => 7,
                'expiryYear' => 2014,
                'cvv' => 123,
            ],
            'clientIp' => '192.168.0.1',
        ];

        $response = $basket->purchase($gateway, $parameters);
    }
}

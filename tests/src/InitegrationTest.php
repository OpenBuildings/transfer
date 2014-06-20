<?php

namespace Harp\Transfer\Test;

use Harp\Transfer\Test\Repo;
use Harp\Transfer\Test\Model;
use Omnipay\Omnipay;

/**
 * @coversNothing
 *
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class InitegrationTest extends AbstractTestCase
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

        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($basket->isSuccessful);

        $this->assertQueries([
            'SELECT Product.* FROM Product WHERE (id = 1) LIMIT 1',
            'SELECT Product.* FROM Product WHERE (id = 2) LIMIT 1',
            'INSERT INTO Basket (isSuccessful, completedAt, responseData, id, deletedAt, isFrozen, value, currency) VALUES (, NULL, NULL, NULL, NULL, , 0, "GBP")',
            'INSERT INTO Item (id, class, transferId, refId, quantity, deletedAt, isFrozen, value) VALUES (NULL, "Harp\\Transfer\\Test\\Model\\ProductItem", NULL, NULL, 2, NULL, , 0), (NULL, "Harp\\Transfer\\Test\\Model\\ProductItem", NULL, NULL, 4, NULL, , 0)',
            'UPDATE Item SET transferId = CASE id WHEN 1 THEN "1" WHEN 2 THEN "1" ELSE transferId END, refId = CASE id WHEN 1 THEN 1 WHEN 2 THEN 2 ELSE refId END WHERE (id IN (1, 2))',
            'SELECT Basket.* FROM Basket WHERE (id IN ("1")) AND (Basket.deletedAt IS NULL)',
            'SELECT Basket.* FROM Basket WHERE (id IN ("1")) AND (Basket.deletedAt IS NULL)',
            'UPDATE Basket SET isSuccessful = 1, completedAt = "'.$basket->completedAt.'", responseData = "{"amount":"1000.00","reference":"'.$basket->responseData['reference'].'","success":true,"message":"Success"}", isFrozen = 1, value = 100000 WHERE (id = "1")',
            'UPDATE Item SET transferId = CASE id WHEN 1 THEN 1 WHEN 2 THEN 1 ELSE transferId END, refId = CASE id WHEN 1 THEN 1 WHEN 2 THEN 2 ELSE refId END, isFrozen = CASE id WHEN 1 THEN 1 WHEN 2 THEN 1 ELSE isFrozen END, value = CASE id WHEN 1 THEN 10000 WHEN 2 THEN 20000 ELSE value END WHERE (id IN (1, 2))',
        ]);
    }
}

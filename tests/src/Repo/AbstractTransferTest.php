<?php

namespace Harp\Transfer\Test\Repo;

use Harp\Transfer\Test\Model;
use Harp\Transfer\Test\AbstractTestCase;
use Guzzle\Http\Client as HttpClient;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Omnipay\Dummy\Message\AuthorizeRequest;
use Omnipay\Dummy\Message\Response;
use stdClass;

/**
 * @coversDefaultClass Harp\Transfer\Repo\AbstractTransfer
 *
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class AbstractTransferTest extends AbstractTestCase
{
    /**
     * @covers ::initialize
     */
    public function testInitialize()
    {
        $repo = Basket::newInstance();

        $this->assertTrue($repo->getSoftDelete());
    }

    /**
     * @coversNothing
     */
    public function testSerialize()
    {
        $item = new Model\Basket(['responseData' => '{"amount":"1000.00","reference":"53a376c2a174f","success":true,"message":"Success"}']);

        $expected = [
            'amount' => '1000.00',
            'reference' => '53a376c2a174f',
            'success' => true,
            'message' => 'Success',
        ];

        $this->assertEquals($expected, $item->responseData);
    }
}

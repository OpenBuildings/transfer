<?php

namespace CL\Transfer\Test;

use Guzzle\Http\Client as HttpClient;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Omnipay\Dummy\Message\AuthorizeRequest;
use Omnipay\Dummy\Message\Response;
use stdClass;

/**
 * @coversDefaultClass CL\Transfer\AbstractTransferRepo
 *
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class AbstractTransferRepoTest extends AbstractTestCase
{
    /**
     * @covers ::initialize
     */
    public function testInitialize()
    {
        $repo = new BasketRepo();

        $this->assertTrue($repo->getSoftDelete());
    }

    /**
     * @coversNothing
     */
    public function testSerialize()
    {
        $item = new Basket(['responseData' => '{"amount":"1000.00","reference":"53a376c2a174f","success":true,"message":"Success"}']);

        $expected = [
            'amount' => '1000.00',
            'reference' => '53a376c2a174f',
            'success' => true,
            'message' => 'Success',
        ];

        $this->assertEquals($expected, $item->responseData);
    }
}

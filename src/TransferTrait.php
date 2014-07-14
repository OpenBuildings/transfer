<?php

namespace CL\Transfer;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\GatewayInterface;
use Harp\Harp\Config;
use Harp\Serializer\Json;
use Harp\Money\FreezableValueTrait;
use DateTime;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
trait TransferTrait
{
    abstract public function getId();
    abstract public function getValue();
    abstract public function getCurrency();

    public static function initialize(Config $config)
    {
        $config
            ->addSerializers([
                new Json('responseData'),
            ]);
    }

    public $isSuccessful = false;
    public $completedAt;
    public $responseData;

    /**
     * @return DateTime|null
     */
    public function getCompletedAt()
    {
        return $this->completedAt ? new DateTime($this->completedAt) : null;
    }

    /**
     * @param DateTime $dateTime
     */
    public function setCompletedAt(DateTime $dateTime)
    {
        $this->completedAt = $dateTime->format('Y-m-d H:i:s');

        return $this;
    }

    public function isSent()
    {
        return $this->responseData !== null;
    }

    public function getRequestParameters(array $defaultParameters)
    {
        $parameters['amount'] = (float) ($this->getValue()->getAmount() / 100);
        $parameters['currency'] = $this->getCurrency()->getCurrencyCode();
        $parameters['transactionReference'] = $this->getId();

        return array_merge_recursive($parameters, $defaultParameters);
    }

    public function sendRequest(RequestInterface $request)
    {
        $response = $request->send();

        if (! $response->isRedirect()) {
            $this->isSuccessful = $response->isSuccessful();
        }

        $this->setCompletedAt(new DateTime());
        $this->responseData = $response->getData();

        return $response;
    }

    public function execute(GatewayInterface $gateway, $method, array $parameters)
    {
        $this->freeze();

        $request = $gateway->$method($this->getRequestParameters($parameters));

        $response = $this->sendRequest($request);

        static::save($this);

        return $response;
    }
}

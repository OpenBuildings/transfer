<?php

namespace Harp\Transfer\Model;

use Harp\Harp\AbstractModel;
use Harp\Transfer\Repo;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\GatewayInterface;
use Harp\Core\Model\SoftDeleteTrait;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;
use DateTime;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractTransfer extends AbstractModel
{
    use SoftDeleteTrait;

    public $id;
    public $isSuccessful = false;
    public $amount = 0;
    public $completedAt;
    public $response;
    public $currency = 'GBP';

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

    public function getAmount()
    {
        return new Money($this->amount, $this->getCurrency());
    }

    public function getCurrency()
    {
        return new Currency($this->currency);
    }

    public function getTotal()
    {
        $prices = $this->getItems()->get()->map(function(AbstractItem $item){
            return $item->getTotalPrice()->getAmount();
        });

        return new Money(array_sum($prices), $this->getCurrency());
    }

    public function freeze()
    {
        foreach ($this->getItems() as $item) {
            $item->freeze();
        }

        return $this;
    }

    public function unfreeze()
    {
        foreach ($this->getItems() as $item) {
            $item->unfreeze();
        }

        return $this;
    }

    public function isSent()
    {
        return (bool) $this->response;
    }

    public function getRequestParameters(array $defaultParameters)
    {
        $parameters = [];

        foreach ($this->getItems() as $item) {
            $parameters['items'] []= [
                'name' => $item->getId(),
                'description' => $item->getName(),
                'price' => (float) ($item->getPrice()->getAmount() / 100),
                'quantity' => $item->quantity,
            ];
        }

        $parameters['amount'] = (float) ($this->getTotal()->getAmount() / 100);
        $parameters['currency'] = $this->currency;
        $parameters['transactionReference'] = $this->getId();

        return array_merge_recursive($parameters, $defaultParameters);
    }

    public function sendRequest(RequestInterface $request)
    {
        $this->response = $request->send();

        if (! $this->response->isRedirect()) {
            $this->isSuccessful = $this->response->isSuccessful();
        }

        $this->amount = $request->getAmountInteger();
        $this->setCompletedAt(new DateTime());

        return $this->response;
    }

    public function execute(GatewayInterface $gateway, $method, array $parameters)
    {
        $this->freeze();

        $request = $gateway->$method($this->getRequestParameters($parameters));

        $response = $this->sendRequest($request);

        $this->getRepo()->save($this);

        return $response;
    }

    abstract public function getItems();
}

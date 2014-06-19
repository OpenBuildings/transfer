<?php

namespace Harp\Transfer\Model;

use Harp\Harp\AbstractModel;
use Harp\Transfer\Repo;
use Harp\Core\Model\SoftDeleteTrait;
use CL\CurrencyConvert\Converter;
use SebastianBergmann\Money\Money;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractItem extends AbstractModel
{
    use SoftDeleteTrait;

    public $id;
    public $class;
    public $transferId;
    public $refId;
    public $quantity = 1;
    public $price = 0;
    public $isFrozen = false;

    public function getName()
    {
        return 'Item';
    }

    public function getPrice()
    {
        $currency = $this->getCurrency();

        if ($this->isFrozen) {
            return new Money($this->price, $currency);
        } else {
            $price = $this->getRefPrice();

            if ($currency != $price->getCurrency()) {
                $price = Converter::get()->convert($price, $currency);
            }

            return $price;
        }
    }

    public function freeze()
    {
        if (! $this->isFrozen) {
            $this->price = $this->getPrice()->getAmount();
            $this->isFrozen = true;
        }

        return $this;
    }

    public function unfreeze()
    {
        $this->isFrozen = false;
        $this->price = null;

        return $this;
    }

    public function setPrice(Money $price)
    {
        $this->price = $price->getAmount();
    }

    public function getTotalPrice()
    {
        return $this->getPrice()->multiply($this->quantity);
    }

    abstract public function getRefPrice();
    abstract public function getCurrency();
}

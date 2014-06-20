<?php

namespace Harp\Transfer\Model;

use Harp\Harp\AbstractModel;
use Harp\Core\Model\SoftDeleteTrait;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractItemGroup extends AbstractModel
{
    use SoftDeleteTrait;

    public $id;
    public $amount = 0;
    public $currency = 'GBP';

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
        $prices = $this->getItems()->get()->map(function (AbstractItem $item) {
            return $item->getTotalPrice()->getAmount();
        });

        return new Money(array_sum($prices), $this->getCurrency());
    }

    public function freeze()
    {
        foreach ($this->getItems() as $item) {
            $item->freeze();
        }

        $this->amount = $this->getTotal()->getAmount();

        return $this;
    }

    public function unfreeze()
    {
        foreach ($this->getItems() as $item) {
            $item->unfreeze();
        }

        $this->amount = null;

        return $this;
    }

    abstract public function getItems();
}

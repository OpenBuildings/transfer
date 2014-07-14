<?php

namespace CL\Transfer;

use Harp\Harp\Config;
use Harp\Harp\Model\SoftDeleteTrait;
use Harp\Money\FreezableValueTrait;
use Harp\Money\CurrencyTrait;
use SebastianBergmann\Money\Money;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
trait ItemGroupTrait
{
    use SoftDeleteTrait;
    use FreezableValueTrait;

    public static function initialize(Config $config)
    {
        SoftDeleteTrait::initialize($config);
        FreezableValueTrait::initialize($config);
    }

    public $id;

    public function getSourceValue()
    {
        $prices = $this->getItems()->map(function ($item) {
            return $item->getTotalValue()->getAmount();
        });

        return new Money(array_sum($prices), $this->getCurrency());
    }

    public function freezeItems()
    {
        foreach ($this->getItems() as $item) {
            $item->freeze();
        }

        return $this;
    }

    public function unfreezeItems()
    {
        foreach ($this->getItems() as $item) {
            $item->unfreeze();
        }

        return $this;
    }

    public function performFreeze()
    {
        $this->freezeItems();
        $this->freezeValue();
    }

    public function performUnfreeze()
    {
        $this->unfreezeItems();
        $this->unfreezeValue();
    }

    abstract public function getItems();
}

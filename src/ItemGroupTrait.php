<?php

namespace CL\Transfer;

use Harp\Harp\Config;
use Harp\Harp\Model\SoftDeleteTrait;
use Harp\Money\FreezableValueTrait;
use Harp\Money\CurrencyTrait;
use Harp\Money\MoneyObjects;
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

    /**
     * Return a sum from all the item values
     *
     * @return Money
     */
    public function getSourceValue()
    {
        return MoneyObjects::sum($this->getItems()->invoke('getTotalValue'));
    }

    /**
     * Call freeze on all the items
     *
     * @return static
     */
    public function freezeItems()
    {
        foreach ($this->getItems() as $item) {
            $item->freeze();
        }

        return $this;
    }

    /**
     * Call unfreeze on all the items
     *
     * @return static
     */
    public function unfreezeItems()
    {
        foreach ($this->getItems() as $item) {
            $item->unfreeze();
        }

        return $this;
    }

    public function performFreeze()
    {
        $this
            ->freezeItems()
            ->freezeValue();
    }

    public function performUnfreeze()
    {
        $this
            ->unfreezeItems()
            ->unfreezeValue();
    }

    abstract public function getItems();
}

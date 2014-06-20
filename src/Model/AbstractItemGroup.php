<?php

namespace CL\Transfer\Model;

use Harp\Harp\AbstractModel;
use Harp\Core\Model\SoftDeleteTrait;
use Harp\Money\Model\FreezableValueTrait;
use Harp\Money\Model\CurrencyTrait;
use SebastianBergmann\Money\Money;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractItemGroup extends AbstractModel
{
    use SoftDeleteTrait;
    use FreezableValueTrait;

    public $id;

    public function getSourceValue()
    {
        $prices = $this->getItems()->get()->map(function (AbstractItem $item) {
            return $item->getTotalValue()->getAmount();
        });

        return new Money(array_sum($prices), $this->getCurrency());
    }

    public function performFreeze()
    {
        foreach ($this->getItems() as $item) {
            $item->freeze();
        }

        $this->setValue($this->getValue());
    }

    public function performUnfreeze()
    {
        foreach ($this->getItems() as $item) {
            $item->unfreeze();
        }

        $this->value = null;
    }

    abstract public function getItems();
}

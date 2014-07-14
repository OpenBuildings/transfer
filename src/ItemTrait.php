<?php

namespace CL\Transfer;

use Harp\Harp\Config;
use Harp\Validate\Assert;
use Harp\Money\FreezableValueTrait;
use Harp\Harp\Model\SoftDeleteTrait;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
trait ItemTrait
{
    use SoftDeleteTrait;
    use FreezableValueTrait;

    public static function initialize(Config $config)
    {
        SoftDeleteTrait::initialize($config);
        FreezableValueTrait::initialize($config);

        $config
            ->addAsserts([
                new Assert\Present('quantity'),
                new Assert\Number('quantity'),
                new Assert\GreaterThan('quantity', 0),
            ]);
    }

    public $id;
    public $transferId;
    public $refId;
    public $quantity = 1;

    public function getDescription()
    {
        return 'Item';
    }

    public function getName()
    {
        return $this->getId();
    }

    public function getTotalValue()
    {
        return $this->getValue()->multiply($this->quantity);
    }
}

<?php

namespace Harp\Transfer\Model;

use Harp\Harp\AbstractModel;
use Harp\Money\Model\FreezableValueTrait;
use Harp\Core\Model\SoftDeleteTrait;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractItem extends AbstractModel
{
    use SoftDeleteTrait;
    use FreezableValueTrait;

    public $id;
    public $class;
    public $transferId;
    public $refId;
    public $quantity = 1;

    public function getName()
    {
        return 'Item';
    }

    public function getTotalValue()
    {
        return $this->getValue()->multiply($this->quantity);
    }
}

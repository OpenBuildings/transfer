<?php

namespace CL\Transfer;

use CL\Transfer\AssertCurrency;
use Harp\Harp\AbstractRepo;
use Harp\Validate\Assert;
use Harp\Money\FreezableValueRepoTrait;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractItemGroupRepo extends AbstractRepo
{
    use FreezableValueRepoTrait;

    public function initialize()
    {
        $this
            ->setSoftDelete(true)
            ->initializeFreezableValue();
    }
}

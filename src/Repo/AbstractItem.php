<?php

namespace Harp\Transfer\Repo;

use Harp\Harp\AbstractRepo;
use Harp\Validate\Assert;
use Harp\Harp\Rel;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractItem extends AbstractRepo
{
    public function initialize()
    {
        $this
            ->setInherited(true)
            ->setSoftDelete(true)
            ->addAsserts([
                new Assert\Number('price'),
                new Assert\Number('quantity'),
                new Assert\GreaterThan('quantity', 0),
            ]);
    }
}

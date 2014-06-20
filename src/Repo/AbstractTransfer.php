<?php

namespace Harp\Transfer\Repo;

use Harp\Serializer;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractTransfer extends AbstractItemGroup
{
    public function initialize()
    {
        parent::initialize();

        $this

            ->addSerializers([
                new Serializer\Json('responseData'),
            ]);
    }
}

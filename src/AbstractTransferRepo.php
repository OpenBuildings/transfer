<?php

namespace CL\Transfer;

use Harp\Serializer;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractTransferRepo extends AbstractItemGroupRepo
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

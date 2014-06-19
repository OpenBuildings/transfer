<?php

namespace Harp\Transfer\Repo;

use Harp\Validate\Assert;
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

            ->addAsserts([
                new Assert\IsInstanceOf('response', 'Omnipay\Common\Message\ResponseInterface'),
            ])

            ->addSerializers([
                new Serializer\Native('response'),
            ]);
    }
}

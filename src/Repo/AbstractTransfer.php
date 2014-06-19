<?php

namespace Harp\Transfer\Repo;

use Harp\Harp\AbstractRepo;
use Harp\Validate\Assert;
use Harp\Serializer;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractTransfer extends AbstractRepo
{
    public function initialize()
    {
        $this

            ->addAsserts([
                new Assert\IsInstanceOf('response', 'Omnipay\Common\Message\ResponseInterface'),
                new Assert\Present('currency'),
                new Assert\LengthEquals('currency', 3),
            ])

            ->addSerializers([
                new Serializer\Native('response'),
            ]);
    }
}

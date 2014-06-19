<?php

namespace Harp\Transfer;

use Harp\Validate\Error;
use Harp\Validate\Assert\AbstractAssertion;
use SebastianBergmann\Money\Currency;
use InvalidArgumentException;

/**
 * Assert that the value is a valid iso currency code
 *
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright (c) 2014 Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class AssertCurrency extends AbstractAssertion
{
    /**
     * @param  object|array $subject
     * @return Error|null
     */
    public function execute($subject)
    {
        if ($this->issetProperty($subject, $this->getName())) {

            $value = $this->getProperty($subject, $this->getName());

            try {
                new Currency($value);
            } catch (InvalidArgumentException $e) {
                return new Error($this->getMessage(), $this->getName());
            }
        }
    }
}

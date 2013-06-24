<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\DataFetcher\Registry;

use InvalidArgumentException;

class ExistingDataFetcherException extends InvalidArgumentException
{
    public function __construct($type)
    {
        parent::__construct(sprintf('Data fetcher of type "%s" already exist.', $type));
    }
}

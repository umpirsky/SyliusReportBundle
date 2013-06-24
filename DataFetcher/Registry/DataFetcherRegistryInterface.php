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

use Sylius\Bundle\ReportBundle\DataFetcher\DataFetcherInterface;

interface DataFetcherRegistryInterface
{
    public function getFetchers();
    public function registerFetcher($name, DataFetcherInterface $fetcher);
    public function unregisterFetcher($name);
    public function hasFetcher($name);
    public function getFetcher($name);
}

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

class DataFetcherRegistry implements DataFetcherRegistryInterface
{
    protected $fetchers;

    public function __construct()
    {
        $this->fetchers = array();
    }

    public function getFetchers()
    {
        return $this->fetchers;
    }

    public function registerFetcher($name, DataFetcherInterface $fetcher)
    {
        if ($this->hasFetcher($name)) {
            throw new ExistingDataFetcherException($name);
        }

        $this->fetchers[$name] = $fetcher;
    }

    public function unregisterFetcher($name)
    {
        if (!$this->hasFetcher($name)) {
            throw new NonExistingDataFetcherException($name);
        }

        unset($this->fetchers[$name]);
    }

    public function hasFetcher($name)
    {
        return isset($this->fetchers[$name]);
    }

    public function getFetcher($name)
    {
        if (!$this->hasFetcher($name)) {
            throw new NonExistingDataFetcherException($name);
        }

        return $this->fetchers[$name];
    }
}

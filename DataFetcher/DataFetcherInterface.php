<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\DataFetcher;

use Symfony\Component\HttpKernel\Bundle\Bundle;

interface DataFetcherInterface
{
    public function fetch(array $configuration);
    public function getConfigurationFormType();
}

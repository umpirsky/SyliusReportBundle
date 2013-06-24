<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\Model;

interface ReportInterface
{
    public function getId();
    public function getFetcher();
    public function setFetcher(DataFetcherInterface $fetcher = null);
    public function getRenderer();
    public function setRenderer(RendererInterface $renderer = null);
}

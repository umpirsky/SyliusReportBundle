<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\Report;

use Sylius\Bundle\ReportBundle\DataFetcher\Registry\DataFetcherRegistryInterface;
use Sylius\Bundle\ReportBundle\Renderer\Registry\RendererRegistryInterface;
use Sylius\Bundle\ReportBundle\Model\ReportInterface;

class Report
{
    protected $fetcherRegistry;
    protected $rendererRegistry;

    public function __construct(DataFetcherRegistryInterface $fetcherRegistry, RendererRegistryInterface $rendererRegistry)
    {
        $this->fetcherRegistry = $fetcherRegistry;
        $this->rendererRegistry = $rendererRegistry;
    }

    public function getFormat(ReportInterface $report)
    {
        return $this->getRender($report)->getFormat();
    }

    public function render(ReportInterface $report)
    {
        $data = $this->getFetcher($report)->fetch($report->getFetcher()->getConfiguration());

        return $this->getRender($report)->render($data, $report->getRenderer()->getConfiguration());
    }

    protected function getFetcher(ReportInterface $report)
    {
        return $this->fetcherRegistry->getFetcher($report->getFetcher()->getType());
    }

    protected function getRender(ReportInterface $report)
    {

        return $this->rendererRegistry->getRenderer($report->getRenderer()->getType());
    }
}

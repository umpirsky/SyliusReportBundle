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

interface RendererInterface
{
    public function getId();
    public function getType();
    public function setType($type);
    public function getConfiguration();
    public function setConfiguration(array $configuration);
    public function getReport();
    public function setReport(ReportInterface $report = null);
}

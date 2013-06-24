<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle;

use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Sylius\Bundle\ResourceBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use Sylius\Bundle\ReportBundle\DependencyInjection\Compiler\RegisterReportDataFetchersPass;
use Sylius\Bundle\ReportBundle\DependencyInjection\Compiler\RegisterReportRendererPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SyliusReportBundle extends Bundle
{
    public static function getSupportedDrivers()
    {
        return array(
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM
        );
    }

    public function build(ContainerBuilder $container)
    {
        $interfaces = array(
            'Sylius\Bundle\ReportBundle\Model\ReportInterface'      => 'sylius.model.report.class',
            'Sylius\Bundle\ReportBundle\Model\DataFetcherInterface' => 'sylius.model.report_data_fetcher.class',
            'Sylius\Bundle\ReportBundle\Model\RendererInterface'    => 'sylius.model.report_renderer.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('sylius_report', $interfaces));
        $container->addCompilerPass(new RegisterReportDataFetchersPass());
        $container->addCompilerPass(new RegisterReportRendererPass());
    }
}

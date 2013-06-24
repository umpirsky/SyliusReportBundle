<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegisterReportDataFetchersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('sylius.registry.report_data_fetcher')) {
            return;
        }

        $registry = $container->getDefinition('sylius.registry.report_data_fetcher');
        $fetchers = array();

        foreach ($container->findTaggedServiceIds('sylius.report_data_fetcher') as $id => $attributes) {
            $fetchers[$attributes[0]['type']] = $attributes[0]['label'];

            $registry->addMethodCall('registerFetcher', array($attributes[0]['type'], new Reference($id)));
        }

        $container->setParameter('sylius.report_data_fetchers', $fetchers);
    }
}

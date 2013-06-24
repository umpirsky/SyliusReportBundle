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

class RegisterReportRendererPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('sylius.registry.report_renderer')) {
            return;
        }

        $registry = $container->getDefinition('sylius.registry.report_renderer');
        $renderers = array();

        foreach ($container->findTaggedServiceIds('sylius.report_renderer') as $id => $attributes) {
            $renderers[$attributes[0]['type']] = $attributes[0]['label'];

            $registry->addMethodCall('registerRenderer', array($attributes[0]['type'], new Reference($id)));
        }

        $container->setParameter('sylius.report_renderers', $renderers);
    }
}

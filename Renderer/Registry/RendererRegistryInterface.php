<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\Renderer\Registry;

use Sylius\Bundle\ReportBundle\Renderer\RendererInterface;

interface RendererRegistryInterface
{
    public function getRenderers();
    public function registerRenderer($name, RendererInterface $renderer);
    public function unregisterRenderer($name);
    public function hasRenderer($name);
    public function getRenderer($name);
}

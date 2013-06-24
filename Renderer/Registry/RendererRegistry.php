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

class RendererRegistry implements RendererRegistryInterface
{
    protected $renderers;

    public function __construct()
    {
        $this->renderers = array();
    }

    public function getRenderers()
    {
        return $this->renderers;
    }

    public function registerRenderer($name, RendererInterface $renderer)
    {
        if ($this->hasRenderer($name)) {
            throw new ExistingRendererException($name);
        }

        $this->renderers[$name] = $renderer;
    }

    public function unregisterRenderer($name)
    {
        if (!$this->hasRenderer($name)) {
            throw new NonExistingRendererException($name);
        }

        unset($this->renderers[$name]);
    }

    public function hasRenderer($name)
    {
        return isset($this->renderers[$name]);
    }

    public function getRenderer($name)
    {
        if (!$this->hasRenderer($name)) {
            throw new NonExistingRendererException($name);
        }

        return $this->renderers[$name];
    }
}

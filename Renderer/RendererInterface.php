<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\Renderer;

use Symfony\Component\HttpKernel\Bundle\Bundle;

interface RendererInterface
{
    public function getFormat();
    public function render(array $data, array $configuration);
    public function getConfigurationFormType();
}

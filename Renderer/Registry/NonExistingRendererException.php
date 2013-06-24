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

use InvalidArgumentException;

class NonExistingRendererException extends InvalidArgumentException
{
    public function __construct($type)
    {
        parent::__construct(sprintf('Renderer of type "%s" does not exist.', $type));
    }
}

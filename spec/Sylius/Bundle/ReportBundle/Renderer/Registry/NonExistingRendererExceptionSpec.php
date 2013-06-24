<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\ReportBundle\Renderer\Registry;

use PhpSpec\ObjectBehavior;

class NonExistingRendererExceptionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('order');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\ReportBundle\Renderer\Registry\NonExistingRendererException');
    }

    public function it_is_an_exception()
    {
        $this->shouldHaveType('Exception');
    }

    public function it_is_a_invalid_argument_exception()
    {
        $this->shouldHaveType('InvalidArgumentException');
    }
}

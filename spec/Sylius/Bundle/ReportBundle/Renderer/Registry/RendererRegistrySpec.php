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
use Sylius\Bundle\ReportBundle\Renderer\Registry\RendererRegistryInterface;
use Sylius\Bundle\ReportBundle\Renderer\RendererInterface;

class RendererRegistrySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\ReportBundle\Renderer\Registry\RendererRegistry');
    }

    public function it_implements_data_renderer_registry_interface()
    {
        $this->shouldImplement('Sylius\Bundle\ReportBundle\Renderer\Registry\RendererRegistryInterface');
    }

    public function it_initializes_renderers_array_by_default()
    {
        $this->getRenderers()->shouldReturn(array());
    }

    public function it_registers_renderer_under_given_type(RendererInterface $renderer)
    {
        $this->hasRenderer('pdf')->shouldReturn(false);
        $this->registerRenderer('pdf', $renderer);
        $this->hasRenderer('pdf')->shouldReturn(true);
    }

    public function it_complains_if_trying_to_register_fercher_with_taken_name(RendererInterface $renderer)
    {
        $this->registerRenderer('pdf', $renderer);

        $this
            ->shouldThrow('Sylius\Bundle\ReportBundle\Renderer\Registry\ExistingRendererException')
            ->duringRegisterRenderer('pdf', $renderer)
        ;
    }

    public function it_unregisters_renderer_with_given_name(RendererInterface $renderer)
    {
        $this->registerRenderer('pdf', $renderer);
        $this->hasRenderer('pdf')->shouldReturn(true);

        $this->unregisterRenderer('pdf');
        $this->hasRenderer('pdf')->shouldReturn(false);
    }

    public function it_retrieves_registered_renderer_by_name(RendererInterface $renderer)
    {
        $this->registerRenderer('pdf', $renderer);
        $this->getRenderer('pdf')->shouldReturn($renderer);
    }

    public function it_complains_if_trying_to_retrieve_non_existing_renderer()
    {
        $this
            ->shouldThrow('Sylius\Bundle\ReportBundle\Renderer\Registry\NonExistingRendererException')
            ->duringGetRenderer('pdf')
        ;
    }
}

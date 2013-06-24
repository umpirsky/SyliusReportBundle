<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\ReportBundle\Report;

use PhpSpec\ObjectBehavior;
use Sylius\Bundle\ReportBundle\Model\DataFetcherInterface as DataFetcherInterfaceModel;
use Sylius\Bundle\ReportBundle\Model\RendererInterface as RendererInterfaceModel;
use Sylius\Bundle\ReportBundle\Model\ReportInterface;
use Sylius\Bundle\ReportBundle\DataFetcher\DataFetcherInterface;
use Sylius\Bundle\ReportBundle\Renderer\RendererInterface;
use Sylius\Bundle\ReportBundle\DataFetcher\Registry\DataFetcherRegistryInterface;
use Sylius\Bundle\ReportBundle\Renderer\Registry\RendererRegistryInterface;

class ReportSpec extends ObjectBehavior
{
    function let(DataFetcherRegistryInterface $fetcherRegistry, RendererRegistryInterface $rendererRegistry)
    {
        $this->beConstructedWith($fetcherRegistry, $rendererRegistry);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\ReportBundle\Report\Report');
    }

    function it_gets_format_from_renderer($fetcherRegistry, $rendererRegistry, ReportInterface $report, DataFetcherInterface $fetcher, RendererInterface $renderer, DataFetcherInterfaceModel $fetcherModel, RendererInterfaceModel $rendererModel)
    {
        $report->getRenderer()->shouldBeCalled()->willReturn($rendererModel);

        $rendererModel->getType()->shouldBeCalled()->willReturn('csv');
        $rendererRegistry->getRenderer('csv')->shouldBeCalled()->willReturn($renderer);

        $renderer->getFormat()->shouldBeCalled()->willReturn('csv');

        $this->getFormat($report)->shouldReturn('csv');
    }

    function it_renders_report($fetcherRegistry, $rendererRegistry, ReportInterface $report, DataFetcherInterface $fetcher, RendererInterface $renderer, DataFetcherInterfaceModel $fetcherModel, RendererInterfaceModel $rendererModel)
    {
        $report->getFetcher()->shouldBeCalled()->willReturn($fetcherModel);
        $report->getRenderer()->shouldBeCalled()->willReturn($rendererModel);

        $fetcherModel->getType()->shouldBeCalled()->willReturn('order');
        $rendererModel->getType()->shouldBeCalled()->willReturn('html');
        $fetcherModel->getConfiguration()->shouldBeCalled()->willReturn(array());
        $rendererModel->getConfiguration()->shouldBeCalled()->willReturn(array());

        $fetcherRegistry->getFetcher('order')->shouldBeCalled()->willReturn($fetcher);
        $rendererRegistry->getRenderer('html')->shouldBeCalled()->willReturn($renderer);

        $fetcher->fetch(array())->shouldBeCalled()->willReturn(array());
        $renderer->render(array(), array())->shouldBeCalled()->willReturn('Lorem ipsum');

        $this->render($report)->shouldReturn('Lorem ipsum');
    }
}

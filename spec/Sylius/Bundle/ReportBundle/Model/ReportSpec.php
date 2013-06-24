<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\ReportBundle\Model;

use PhpSpec\ObjectBehavior;
use Sylius\Bundle\ReportBundle\Model\DataFetcher;
use Sylius\Bundle\ReportBundle\Model\Renderer;

class ReportSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\ReportBundle\Model\Report');
    }

    function it_implements_renderer_interface()
    {
        $this->shouldImplement('Sylius\Bundle\ReportBundle\Model\ReportInterface');
    }

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_name_by_default()
    {
        $this->getName()->shouldReturn(null);
    }

    function its_name_is_mutable()
    {
        $this->setName('Total orders');
        $this->getName()->shouldReturn('Total orders');
    }

    function it_has_no_data_fetcher_by_default()
    {
        $this->getFetcher()->shouldReturn(null);
    }

    function its_data_fetcher_is_mutable(DataFetcher $fetcher)
    {
        $this->setFetcher($fetcher);
        $this->getFetcher()->shouldReturn($fetcher);
    }

    function it_has_no_renderer_by_default()
    {
        $this->getRenderer()->shouldReturn(null);
    }

    function its_renderer_is_mutable(Renderer $renderer)
    {
        $this->setRenderer($renderer);
        $this->getRenderer()->shouldReturn($renderer);
    }
}

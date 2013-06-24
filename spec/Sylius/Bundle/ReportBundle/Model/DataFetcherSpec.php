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

use Sylius\Bundle\ReportBundle\Model\Report;
use PhpSpec\ObjectBehavior;
use DateTime;

class DataFetcherSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\ReportBundle\Model\DataFetcher');
    }

    function it_implements_data_fetcher_interface()
    {
        $this->shouldImplement('Sylius\Bundle\ReportBundle\Model\DataFetcherInterface');
    }

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_type_by_default()
    {
        $this->getType()->shouldReturn(null);
    }

    function its_type_is_mutable()
    {
        $this->setType('order');
        $this->getType()->shouldReturn('order');
    }

    function it_initializes_array_for_configuration_by_default()
    {
        $this->getConfiguration()->shouldReturn(array());
    }

    function its_configuration_is_mutable()
    {
        $configuration = array('dateTo' => new DateTime());

        $this->setConfiguration($configuration);
        $this->getConfiguration()->shouldReturn($configuration);
    }

    function it_has_no_report_by_default()
    {
        $this->getReport()->shouldReturn(null);
    }

    function its_report_is_mutable(Report $report)
    {
        $this->setReport($report);
        $this->getReport()->shouldReturn($report);
    }
}

<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\ReportBundle\Renderer;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Output\OutputInterface;

class ConsoleRendererSpec extends ObjectBehavior
{
    function let(TableHelper $tableHelper, OutputInterface $output)
    {
        $this->beConstructedWith($tableHelper, $output);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\ReportBundle\Renderer\ConsoleRenderer');
    }

    function it_implements_report_renderer_interface()
    {
        $this->shouldImplement('Sylius\Bundle\ReportBundle\Renderer\RendererInterface');
    }

    function it_renders_data_using_console_table_helper($tableHelper, $output)
    {
        $data = array(
            array('1', 'Poland', 'PL'),
            array('2', 'Germany', 'DE'),
            array('3', 'Romania', 'RO'),
        );

        $tableHelper->setLayout(TableHelper::LAYOUT_DEFAULT)->shouldBeCalled()->willReturn($tableHelper);
        $tableHelper->setRows($data)->shouldBeCalled()->willReturn($tableHelper);
        $tableHelper->render($output)->shouldBeCalled();

        $this->render($data, array('layout' => TableHelper::LAYOUT_DEFAULT));
    }
}

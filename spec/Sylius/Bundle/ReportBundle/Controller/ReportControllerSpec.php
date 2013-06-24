<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\ReportBundle\Controller;

use PhpSpec\ObjectBehavior;

class ReportControllerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('sylius', 'report', 'SyliusReportBundle:Report');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\ReportBundle\Controller\ReportController');
    }

    function it_is_a_controller()
    {
        $this->shouldHaveType('Sylius\Bundle\ResourceBundle\Controller\ResourceController');
    }
}

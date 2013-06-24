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

use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Output\OutputInterface;

class ConsoleRenderer implements RendererInterface
{
    protected $tableHelper;
    protected $output;

    public function __construct(TableHelper $tableHelper, OutputInterface $output)
    {
        $this->tableHelper = $tableHelper;
        $this->output = $output;
    }

    public function getFormat()
    {
        return 'text';
    }

    public function render(array $data, array $configuration)
    {
        $this
            ->tableHelper
            ->setLayout($configuration['layout'])
            ->setRows($data)
            ->setRows($data)
            ->render($this->output)
        ;
    }

    public function getConfigurationFormType()
    {
        return 'sylius_report_renderer_console_configuration';
    }
}

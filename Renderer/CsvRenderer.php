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

use RuntimeException;

class CsvRenderer implements RendererInterface
{
    public function getFormat()
    {
        return 'csv';
    }

    public function render(array $data, array $configuration)
    {
        ob_start();
        $output = fopen('php://output', 'w');

        foreach ($data as $fields) {
            if (false === fputcsv($output, $fields, $configuration['delimiter'], $configuration['enclosure'])) {
                throw new RuntimeException('Failed to write CSV content.');
            }
        }

        fclose($output);

        return ob_get_clean();
    }

    public function getConfigurationFormType()
    {
        return 'sylius_report_renderer_csv_configuration';
    }
}

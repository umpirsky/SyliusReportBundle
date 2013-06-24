<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\Controller;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;

class ReportController extends ResourceController
{
    public function renderAction()
    {
        $report = $this->get('sylius.report');
        $resource = $this->findOr404();

        return $this->handleView(
            $this
                ->view()
                ->setFormat($report->getFormat($resource))
                ->setData($report->render($resource))
        );
    }
}

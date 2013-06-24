<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\Rest\Handler;

use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandler;
use FOS\Rest\Util\Codes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CsvHandler
{
    public function createResponse(ViewHandler $handler, View $view, Request $request)
    {
        $view->setHeader('Content-type', 'text/csv');

        return new Response($view->getData(), Codes::HTTP_OK, $view->getHeaders());
    }
}

<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\Model;

class Report implements ReportInterface
{
    protected $id;
    protected $name;
    protected $fetcher;
    protected $renderer;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getFetcher()
    {
        return $this->fetcher;
    }

    public function setFetcher(DataFetcherInterface $fetcher = null)
    {
        $this->fetcher = $fetcher;

        $fetcher->setReport($this);
    }

    public function getRenderer()
    {
        return $this->renderer;
    }

    public function setRenderer(RendererInterface $renderer = null)
    {
        $this->renderer = $renderer;

        $renderer->setReport($this);
    }
}

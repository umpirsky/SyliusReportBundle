<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\DataFetcher;

use Doctrine\ORM\EntityRepository;

abstract class OrmDataFetcher implements DataFetcherInterface
{
    protected $repository;

    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function findAll()
    {
        return $this->repository->findAll();
    }
}

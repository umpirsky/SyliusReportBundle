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
use Sylius\Bundle\ResourceBundle\Model\TimestampableInterface;
use InvalidArgumentException;
use YaLinqo\Enumerable;

class OrmDataFetcher implements DataFetcherInterface
{
    protected $repository;

    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function fetch(array $configuration)
    {
        return Enumerable::from($this->findAll())
            ->groupBy(function($item) use ($configuration) {
                if (!$item instanceof TimestampableInterface) {
                    throw new InvalidArgumentException('Data model must implement TimestampableInterface.');
                }

                return $item->getCreatedAt()->format($configuration['group']);
            }, null, function($items) use ($configuration) {
                return array($items[0]->getCreatedAt()->format($configuration['group']), Enumerable::from($items)->count());
            })
            ->toValues()
            ->toArray()
        ;
    }

    public function getConfigurationFormType()
    {
        return 'sylius_report_data_fetcher_orm_configuration';
    }

    protected function findAll()
    {
        return $this->repository->findAll();
    }
}

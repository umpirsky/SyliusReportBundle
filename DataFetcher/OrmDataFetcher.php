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
use Symfony\Component\PropertyAccess\PropertyAccess;
use Sylius\Bundle\ResourceBundle\Model\TimestampableInterface;
use YaLinqo\Enumerable;
use InvalidArgumentException;

class OrmDataFetcher implements DataFetcherInterface
{
    protected $configurationFormType;
    protected $repository;

    public function __construct($configurationFormType, EntityRepository $repository)
    {
        $this->configurationFormType = $configurationFormType;
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
                return array(
                    $items[0]->getCreatedAt()->format($configuration['group']),
                    Enumerable::from($items)->sum(function($item) use ($configuration) {
                        return PropertyAccess::getPropertyAccessor()->getValue($item, $configuration['property']);
                    })
                );
            })
            ->toValues()
            ->toArray()
        ;
    }

    public function getConfigurationFormType()
    {
        return $this->configurationFormType;
    }

    protected function findAll()
    {
        return $this->repository->findAll();
    }
}

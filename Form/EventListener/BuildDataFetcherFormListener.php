<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\Form\EventListener;

use Sylius\Bundle\ReportBundle\DataFetcher\Registry\DataFetcherRegistryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class BuildDataFetcherFormListener implements EventSubscriberInterface
{
    private $fetcherRegistry;
    private $factory;

    public function __construct(DataFetcherRegistryInterface $fetcherRegistry, FormFactoryInterface $factory)
    {
        $this->fetcherRegistry = $fetcherRegistry;
        $this->factory = $factory;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND     => 'preBind'
        );
    }

    public function preSetData(DataEvent $event)
    {
        $fetcher = $event->getData();
        $form = $event->getForm();

        if (null === $fetcher || null === $fetcher->getId()) {
            return;
        }

        $this->addConfigurationFields($form, $fetcher->getType(), $fetcher->getConfiguration());
    }

    public function preBind(DataEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (empty($data) || !array_key_exists('type', $data)) {
            return;
        }

        $this->addConfigurationFields($form, $data['type']);
    }

    protected function addConfigurationFields(FormInterface $form, $fetcherType, array $data = array())
    {
        $fetcher = $this->fetcherRegistry->getFetcher($fetcherType);
        $configurationField = $this->factory->createNamed('configuration', $fetcher->getConfigurationFormType(), $data);

        $form->add($configurationField);
    }
}

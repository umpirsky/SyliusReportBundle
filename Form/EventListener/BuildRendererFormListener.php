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

use Sylius\Bundle\ReportBundle\Renderer\Registry\RendererRegistryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class BuildRendererFormListener implements EventSubscriberInterface
{
    private $rendererRegistry;
    private $factory;

    public function __construct(RendererRegistryInterface $rendererRegistry, FormFactoryInterface $factory)
    {
        $this->rendererRegistry = $rendererRegistry;
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
        $renderer = $event->getData();
        $form = $event->getForm();

        if (null === $renderer || null === $renderer->getId()) {
            return;
        }

        $this->addConfigurationFields($form, $renderer->getType(), $renderer->getConfiguration());
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

    protected function addConfigurationFields(FormInterface $form, $rendererType, array $data = array())
    {
        $renderer = $this->rendererRegistry->getRenderer($rendererType);
        $configurationField = $this->factory->createNamed('configuration', $renderer->getConfigurationFormType(), $data);

        $form->add($configurationField);
    }
}

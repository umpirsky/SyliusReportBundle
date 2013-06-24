<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Sylius\Bundle\ReportBundle\DataFetcher\Registry\DataFetcherRegistryInterface;
use Sylius\Bundle\ReportBundle\Form\EventListener\BuildDataFetcherFormListener;

class DataFetcherType extends AbstractType
{
    protected $dataClass;
    protected $fetcherRegistry;

    public function __construct($dataClass, DataFetcherRegistryInterface $fetcherRegistry)
    {
        $this->dataClass = $dataClass;
        $this->fetcherRegistry = $fetcherRegistry;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventSubscriber(new BuildDataFetcherFormListener($this->fetcherRegistry, $builder->getFormFactory()))
            ->add('type', 'sylius_report_data_fetcher_choice', array(
                'label' => 'sylius.form.data_fetcher.type'
            ))
        ;

        $prototypes = array();
        $fetchers = $this->fetcherRegistry->getFetchers();

        foreach ($fetchers as $name => $fetcher) {
            $prototypes[$name] = $builder->create('configuration', $fetcher->getConfigurationFormType())->getForm();
        }

        $builder->setAttribute('prototypes', $prototypes);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $this->vars['prototypes'] = array();

        foreach ($form->getConfig()->getAttribute('prototypes') as $name => $prototype) {
            $view->vars['prototypes'][$name] = $prototype->createView($view);
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => $this->dataClass
            ))
        ;
    }

    public function getName()
    {
        return 'sylius_report_data_fetcher';
    }
}

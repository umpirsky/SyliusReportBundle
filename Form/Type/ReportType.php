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
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sylius\Bundle\ReportBundle\DataFetcher\Registry\DataFetcherRegistryInterface;
use Sylius\Bundle\ReportBundle\Renderer\Registry\RendererRegistryInterface;

class ReportType extends AbstractType
{
    protected $dataClass;
    protected $fetcherRegistry;
    protected $rendererRegistry;

    public function __construct($dataClass, DataFetcherRegistryInterface $fetcherRegistry, RendererRegistryInterface $rendererRegistry)
    {
        $this->dataClass = $dataClass;
        $this->fetcherRegistry = $fetcherRegistry;
        $this->rendererRegistry = $rendererRegistry;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'sylius.form.report.name'
            ))
            ->add('fetcher', 'sylius_report_data_fetcher', array(
                'label' => 'sylius.form.report.fetcher'
            ))
            ->add('renderer', 'sylius_report_renderer', array(
                'label' => 'sylius.form.report.renderer'
            ))
        ;
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
        return 'sylius_report';
    }
}

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
use Sylius\Bundle\ReportBundle\Renderer\Registry\RendererRegistryInterface;
use Sylius\Bundle\ReportBundle\Form\EventListener\BuildRendererFormListener;

class RendererType extends AbstractType
{
    protected $dataClass;
    protected $rendererRegistry;

    public function __construct($dataClass, RendererRegistryInterface $rendererRegistry)
    {
        $this->dataClass = $dataClass;
        $this->rendererRegistry = $rendererRegistry;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventSubscriber(new BuildRendererFormListener($this->rendererRegistry, $builder->getFormFactory()))
            ->add('type', 'sylius_report_renderer_choice', array(
                'label' => 'sylius.form.renderer.type'
            ))
        ;

        $prototypes = array();
        $renderers = $this->rendererRegistry->getRenderers();

        foreach ($renderers as $name => $renderer) {
            $prototypes[$name] = $builder->create('configuration', $renderer->getConfigurationFormType())->getForm();
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
        return 'sylius_report_renderer';
    }
}

<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\Form\Type\Renderer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Console\Helper\TableHelper;

class ConsoleConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('layout', 'choice', array(
                'label' => 'sylius.form.renderer.console_configuration.layout',
                'choices' => array(
                    TableHelper::LAYOUT_DEFAULT    => 'sylius.form.renderer.console_configuration.layout.default',
                    TableHelper::LAYOUT_BORDERLESS => 'sylius.form.renderer.console_configuration.layout.borderless',
                ),
                'constraints' => array(
                    new NotBlank()
                )
            ))
        ;
    }

    public function getName()
    {
        return 'sylius_report_renderer_console_configuration';
    }
}

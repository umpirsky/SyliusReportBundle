<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ReportBundle\Form\Type\DataFetcher;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class OrmConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('group', 'choice', array(
                'label'       => 'sylius.form.data_fetcher.order_configuration.group',
                'choices'     => array(
                    'd' => 'sylius.form.data_fetcher.order_configuration.group.day',
                    'w' => 'sylius.form.data_fetcher.order_configuration.group.week',
                    'm' => 'sylius.form.data_fetcher.order_configuration.group.month',
                    'Y' => 'sylius.form.data_fetcher.order_configuration.group.year',
                ),
                'constraints' => array(
                    new NotBlank()
                )
            ))
        ;
    }

    public function getName()
    {
        return 'sylius_report_data_fetcher_orm_configuration';
    }
}

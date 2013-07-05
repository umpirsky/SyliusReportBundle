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
    protected $name;
    protected $propertyChoices;

    public function __construct($name, array $propertyChoices)
    {
        $this->name = $name;
        $this->propertyChoices = $propertyChoices;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('property', 'choice', array(
                'label'       => 'sylius.form.data_fetcher.orm_configuration.property',
                'choices'     => $this->propertyChoices,
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('group', 'choice', array(
                'label'       => 'sylius.form.data_fetcher.orm_configuration.group',
                'choices'     => array(
                    'd' => 'sylius.form.data_fetcher.orm_configuration.group.day',
                    'w' => 'sylius.form.data_fetcher.orm_configuration.group.week',
                    'm' => 'sylius.form.data_fetcher.orm_configuration.group.month',
                    'Y' => 'sylius.form.data_fetcher.orm_configuration.group.year',
                ),
                'constraints' => array(
                    new NotBlank()
                )
            ))
        ;
    }

    public function getName()
    {
        return $this->name;
    }
}

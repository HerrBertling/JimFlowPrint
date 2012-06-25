<?php

namespace Jimdo\JimkanbanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $data = $options['data'];

        $builder
                ->add('name', 'text', array(
                    'label' => 'Name'
                ))
                ->add('backgroundColor', 'text', array(
                    'label' => 'Background Color',
                    'attr' => array(
                        'class' => 'jk-color-picker ticket'
                    )
                ))
                ->add('isBackgroundFilled', 'checkbox', array(
                    'label' => 'Fill entire background',
                    'required' => false
                ))
        ->add('isFallback', $this->getIsFallbackType($data->getIsFallback()), array(
                    'label' => 'Use if no or unknown type is specified?',
                    'required' => false,
                ))
        ;
    }

    private function getIsFallbackType($isFallback)
    {
        return $isFallback ? 'hidden' : 'checkbox';
    }

    public function getName()
    {
        return 'jimdo_jimkanbanbundle_tickettypetype';
    }

}

<?php

namespace AltCloud\Instance3EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AgendaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
        ;
    }

    public function getName()
    {
        return 'altcloud_instance3eventbundle_agendatype';
    }
}

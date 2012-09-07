<?php

namespace AltCloud\Instance3EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class EventType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('start')
            ->add('end')
            ->add('venue')
			->add('agenda', 'entity', array(
    								'class' => 'ACInst3EventBundle:Agenda',
    							    'required' => true,
    								'property' => 'title'	
									)
				 )
			->add('media', 'entity', array(
    								'class' => 'ACInst3MediaBundle:Media',
    							    'required' => false,
    								'property' => 'title'	
									)
				 )
			->add('gallery', 'entity', array(
    								'class' => 'ACInst3MediaBundle:Gallery',
    							    'required' => false,
    								'property' => 'title'	
									)
				 );
    }

    public function getName()
    {
        return 'altcloud_instance3eventbundle_eventtype';
    }
}

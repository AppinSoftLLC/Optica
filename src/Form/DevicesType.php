<?php

namespace App\Form;

use App\Entity\Devices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('serial')
            ->add('name')
            ->add('maker')
            ->add('model')
            ->add('produced')
            ->add('price')
            ->add('roomid')
            ->add('statusid')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Devices::class,
        ]);
    }
}

?>
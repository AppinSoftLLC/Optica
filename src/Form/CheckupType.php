<?php

namespace App\Form;

use App\Entity\Checkup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $builder
        //     ->add('dates')
        //     ->add('values')
        //     ->add('deviceid')
        //     ->add('checkupitemid')
        // ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // 'data_class' => Checkup::class,
        ]);
    }
}

?>
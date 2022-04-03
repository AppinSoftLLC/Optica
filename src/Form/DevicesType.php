<?php

namespace App\Form;

use App\Entity\Devices;
use App\Entity\Rooms;
use App\Entity\Status;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DevicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('serial', TextType::class, [
                'label' => 'Serial:',
                'label_attr' => ['class' => 'col-form-label'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('name', TextType::class, [
                'label' => 'Name:',
                'label_attr' => ['class' => 'col-form-label'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('maker', TextType::class, [
                'label' => 'Maker:',
                'label_attr' => ['class' => 'col-form-label'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('model', TextType::class, [
                'label' => 'Model:',
                'label_attr' => ['class' => 'col-form-label'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('produced', TextType::class, [
                'label' => 'Model year:',
                'label_attr' => ['class' => 'col-form-label'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('price', TextType::class, [
                'label' => 'Price:',
                'label_attr' => ['class' => 'col-form-label'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('roomid', EntityType::class, [
                'class' => Rooms::class,
                'choice_label' => 'name',
                'label' => 'Room #:',
                'label_attr' => ['class' => 'col-form-label'],
                'attr' => ['class' => 'form-select'],
            ])
            ->add('statusid', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'titles',
                'label' => 'Status:',
                'label_attr' => ['class' => 'col-form-label'],
                'attr' => ['class' => 'form-select'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Devices::class,
        ]);
    }
}

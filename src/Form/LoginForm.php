<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Username',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter username']
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter password', 'aria-label' => 'Password', 'aria-describedby' => 'password-addon'],
                'mapped' => false
            ]);
    }

    public function getBlockPrefix() {
        return '';
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        
    }
}

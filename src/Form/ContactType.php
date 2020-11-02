<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'attr' => array(
                    'placeholder' => 'Votre e-mail'
                )
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => array(
                    'placeholder' => 'Votre nom'
                )
            ])
            ->add('subject', TextType::class, [
                'label' => 'Sujet',
                'attr' => array(
                    'placeholder' => 'Sujet de vote message'
                )
            ])

            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'attr' => array(
                    'placeholder' => 'Votre message'
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\User;
use \Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class, [
                'label' => 'E-mail',
                'attr' => array(
                    'placeholder' => 'Courriel du nouveau membre'
                )
            ])
            ->add('username',TextType::class, [
                'label' => 'Nom',
                'attr' => array(
                    'placeholder' => 'Nom et prénom du nouveau membre'
                )
            ])

            ->add('phone',PhoneNumberType::class, [
                'label' => 'Téléphone',
                'widget' => PhoneNumberType::WIDGET_COUNTRY_CHOICE,
                'preferred_country_choices' => array( 'FR'),

            ])

            ->add($builder->create('rolesRadius',choiceType::class ,array(
                'label' => 'Rôle sur le site',
                'expanded' => true,
                'mapped' => false,
                'required' => true,
                'data' => 'USER',
                'choices' => array(
                    'Utilisateur' => "USER",
                    'Modérateur' => "MODERATOR",
                    'Administrateur' => "ADMIN"

                )
  )))


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

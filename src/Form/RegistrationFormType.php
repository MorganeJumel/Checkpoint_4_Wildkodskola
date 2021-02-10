<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', TextType::class, [
            'label_attr' => array(
                'class' => 'form-label',
            ),
            'label' => 'E-mail',
            'attr' => array(
                'placeholder' => 'E-mail',
                'class' => 'form-control',
            )
        ])
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'label_attr' => array(
                'class' => 'form-label',
            ),
            'label' => 'I agree to the terms',
            'constraints' => [
                new IsTrue([
                    'message' => 'You should agree to our terms.',
                ]),
            ],
        ])
        ->add('plainPassword', PasswordType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'label_attr' => array(
                'class' => 'form-label',
            ),
            'label' => 'Password',
            'attr' => array(
                'placeholder' => 'Password',
                'class' => 'form-control',
            ),
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
        ])
        ->add('firstname', TextType::class, [
            'label_attr' => array(
                'class' => 'form-label',
            ),
            'label' => 'First name',
            'attr' => array(
                'placeholder' => 'First name',
                'class' => 'form-control',
            )
        ])
        ->add('lastname', TextType::class, [
            'label_attr' => array(
                'class' => 'form-label',
            ),
            'label' => 'Last name',
            'attr' => array(
                'placeholder' => 'Last name',
                'class' => 'form-control',
            )
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

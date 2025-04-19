<?php

namespace App\Form;

use App\Entity\User;
use App\Enum\Diet;
use App\Enum\Gender;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Imię',
                'constraints' => [
                    new NotBlank(['message' => 'Imię jest wymagane.']),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nazwisko',
                'constraints' => [
                    new NotBlank(['message' => 'Nazwisko jest wymagane.']),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Płeć',
                'choices' => [
                    Gender::Male->label() => Gender::Male,
                    Gender::Female->label() => Gender::Female,
                ],
                'placeholder' => 'Wybierz płeć',
                'constraints' => [
                    new NotBlank(['message' => 'Wybierz płeć.']),
                ],
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Numer telefonu',
                'required' => true,
                'attr' => [
                    'maxlength' => 20
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Numer telefonu jest wymagany.']),
                    new Length(['min' => 9, 'max' => 20]),
                    new Regex([
                        'pattern' => '/^\+?[0-9\s\-]*$/',
                        'message' => 'Wprowadź poprawny numer telefonu.'
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adres email',
                'constraints' => [
                    new NotBlank(['message' => 'Email jest wymagany.']),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Hasło'],
                'second_options' => ['label' => 'Powtórz hasło'],
                'invalid_message' => 'Hasła muszą być identyczne!',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Hasło jest wymagane.']),
                    new Length([
                        'min' => 8,
                        'max' => 4096,
                        'minMessage' => 'Hasło musi mieć co najmniej {{ limit }} znaków.',
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
                        'message' => 'Hasło musi zawierać przynajmniej 1 małą literę, 1 dużą literę, 1 cyfrę i 1 znak specjalny.',
                    ]),
                ],
            ])
            ->add('diet', ChoiceType::class, [
                'label' => 'Dieta',
                'choices' => [
                    Diet::Meat->label() => Diet::Meat,
                    Diet::Vegetarian->label() => Diet::Vegetarian,
                    Diet::Vegan->label() => Diet::Vegan,
                ],
                'placeholder' => 'Wybierz dietę',
                'constraints' => [
                    new NotBlank(['message' => 'Wybierz rodzaj diety.']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom',
                'attr' => ['class' => 'input is-success column is-two-fifths is-rounded',
                    'style' => ' text-align: center']])
            ->add('lastName', TextType::class, [
                'label' => 'Last Name',
                'attr' =>['class' => 'input is-success column is-two-fifths is-rounded',
                    'style' => ' text-align: center']
            ])
            ->add('picture', TextType::class, [
                'label' => 'Image',
                'attr' =>['class' => 'input is-success column is-two-fifths is-rounded',
                    'style' => ' text-align: center'],
                'required' => false
            ])
            ->add('duckname', TextType::class, [
                'label' => 'Nom de canard',
                'attr' =>['class' => 'input is-success column is-two-fifths is-rounded',
                    'style' => ' text-align: center']
            ])
            ->add('mail', TextType::class, [
                'label' => 'Email',
                'attr' =>['class' => 'input is-success column is-two-fifths is-rounded',
                    'style' => ' text-align: center']
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de Passe',
                'attr' =>['class' => 'input is-success column is-two-fifths is-rounded',
                    'style' => ' text-align: center']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}

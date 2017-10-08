<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 08/10/2017
 * Time: 14:41
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', TextType::class,
                [
                'attr'=>
                    [
                        'id'=>'username', 'class'=>'validate'
                    ]
                ]
            )
            ->add('_password', PasswordType::class,
                [
                    'attr'=>
                        [
                            'id'=>'password', 'class'=>'validate'
                        ]
                ]);
    }
}
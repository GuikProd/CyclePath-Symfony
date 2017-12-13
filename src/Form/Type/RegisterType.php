<?php

declare(strict_types=1);

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form\Type;

use App\Interactors\UserInteractor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * Class RegisterType
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3,
                        'minMessage' => '',
                        'max' => 75,
                        'maxMessage' => ''
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3,
                        'minMessage' => '',
                        'max' => 150,
                        'maxMessage' => ''
                    ])
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3,
                        'minMessage' => '',
                        'max' => 25,
                        'maxMessage' => ''
                    ])
                ]
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserInteractor::class
        ]);
    }
}

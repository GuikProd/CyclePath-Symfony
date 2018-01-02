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

namespace App\Subscribers\Form;

use App\Interactors\UserInteractor;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Subscribers\Interfaces\Form\RegisterFormSubscriberInterface;

/**
 * Class RegisterFormSubscriber.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterFormSubscriber implements EventSubscriberInterface, RegisterFormSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * RegisterFormSubscriber constructor.
     *
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::SUBMIT => 'onSubmit',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onSubmit(FormEvent $event): void
    {
        if (!$event->getData()->getUsername() || !$event->getData()->getEmail() || !$event->getData()->getPlainPassword()) {
            $event->getForm()->addError(
                new FormError(
                    'The required fields must be filled !'
                )
            );
        } else {
            $username = $this->entityManagerInterface
                             ->getRepository(UserInteractor::class)
                             ->getUserByUsername($event->getData()->getUsername());

            $email = $this->entityManagerInterface
                          ->getRepository(UserInteractor::class)
                          ->getUserByEmail($event->getData()->getEmail());

            if ($username || $email) {
                $event->getForm()->addError(
                    new FormError('This credentials already exist !')
                );
            }
        }
    }
}

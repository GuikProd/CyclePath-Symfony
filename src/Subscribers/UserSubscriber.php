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

namespace App\Subscribers;

use Twig\Environment;
use App\Events\User\UserCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UserSubscriber
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserSubscriber implements EventSubscriberInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * UserSubscriber constructor.
     *
     * @param Environment $twig
     * @param \Swift_Mailer $mailer
     */
    public function __construct(Environment $twig, \Swift_Mailer $mailer)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            UserCreatedEvent::NAME => 'onUserCreated'
        ];
    }

    /**
     * @param UserCreatedEvent $event
     */
    public function onUserCreated(UserCreatedEvent $event)
    {
        if (!$user = $event->getUser()) {
            return;
        }

        $message = (new \Swift_Message('Your account has been created at CyclePath !'))
            ->setFrom('security@cyclepath.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->twig->render(
                    'email/registration.html.twig',
                    [
                        'user' => $user
                    ]
                )
            );

        $this->mailer->send($message);
    }
}

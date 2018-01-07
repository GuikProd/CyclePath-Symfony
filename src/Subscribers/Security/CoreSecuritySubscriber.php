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

namespace App\Subscribers\Security;

use Twig\Environment;
use App\Events\User\UserCreatedEvent;
use App\Events\User\UserValidatedEvent;
use App\Loggers\Interfaces\CoreLoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Subscribers\Interfaces\Security\CoreSecuritySubscriberInterface;

/**
 * Class CoreSecuritySubscriber.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class CoreSecuritySubscriber implements EventSubscriberInterface, CoreSecuritySubscriberInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var \Swift_Mailer
     */
    private $swiftMailer;

    /**
     * @var CoreLoggerInterface
     */
    private $loggerInterface;

    /**
     * CoreSecuritySubscriber constructor.
     *
     * @param Environment         $twig
     * @param \Swift_Mailer       $swiftMailer
     * @param CoreLoggerInterface $loggerInterface
     */
    public function __construct(
        Environment $twig,
        \Swift_Mailer $swiftMailer,
        CoreLoggerInterface $loggerInterface
    ) {
        $this->twig = $twig;
        $this->swiftMailer = $swiftMailer;
        $this->loggerInterface = $loggerInterface;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            UserCreatedEvent::NAME => 'onUserCreated',
            UserValidatedEvent::NAME => 'onUserValidated',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onUserCreated(UserCreatedEvent $event): void
    {
        $message = (new \Swift_Message('Your account has been created at CyclePath !'))
                    ->setFrom('account_management@cyclepath.com')
                    ->setTo($event->getUser()->getEmail())
                    ->setBody(
                        $this->twig->render(
                            'Emails/Security/registration.html.twig',
                            [
                                'user' => $event->getUser(),
                            ]
                        ),
                        'text/html'
                    );

        $this->loggerInterface->onUserLog(
            $event->getMessage(),
            1
        );

        $this->swiftMailer->send($message);
    }

    /**
     * {@inheritdoc}
     */
    public function onUserValidated(UserValidatedEvent $event): void
    {
        $message = (new \Swift_Message('Your account has been validated !'))
                    ->setFrom('account_management@cyclepath.com')
                    ->setTo($event->getUser()->getEmail())
                    ->setBody(
                        $this->twig->render(
                            'Emails/Security/validation.html.twig',
                            [
                                'user' => $event->getUser(),
                            ]
                        ),
                        'text/html'
                    );

        $this->swiftMailer->send($message);
    }
}

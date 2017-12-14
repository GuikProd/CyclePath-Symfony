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
use App\Subscribers\Interfaces\CoreSecuritySubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class CoreSecuritySubscriber
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
     * CoreSecuritySubscriber constructor.
     *
     * @param Environment $twig
     * @param \Swift_Mailer $swiftMailer
     */
    public function __construct(
        Environment $twig,
        \Swift_Mailer $swiftMailer
    ) {
        $this->twig = $twig;
        $this->swiftMailer = $swiftMailer;
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
     * {@inheritdoc}
     */
    public function onUserCreated(UserCreatedEvent $event): void
    {
        $message = (new \Swift_Message('Your account has been created at CyclePath !'))
                    ->setFrom('account_management@cyclepath.com')
                    ->setTo($event->getUser()->getEmail())
                    ->setBody(
                        $this->twig->render(
                            'email/registration.html.twig',
                            [
                                'user' => $event->getUser()
                            ]
                        )
                    );

        $this->swiftMailer->send($message);
    }
}

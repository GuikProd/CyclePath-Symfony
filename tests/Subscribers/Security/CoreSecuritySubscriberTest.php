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

namespace App\Tests\Subscribers\Security;

use Twig\Environment;
use PHPUnit\Framework\TestCase;
use App\Events\User\UserCreatedEvent;
use App\Events\User\UserValidatedEvent;
use App\Loggers\Interfaces\CoreLoggerInterface;
use App\Subscribers\Security\CoreSecuritySubscriber;

/**
 * Class CoreSecuritySubscriberTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class CoreSecuritySubscriberTest extends TestCase
{
    public function testLinkedEvent()
    {
        $twigMock = $this->getMockBuilder(Environment::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $swiftMailerMock = $this->getMockBuilder(\Swift_Mailer::class)
                                ->disableOriginalConstructor()
                                ->getMock();

        $loggerMock = $this->getMockBuilder(CoreLoggerInterface::class)
                           ->disableOriginalConstructor()
                           ->getMock();

        $subscriber = new CoreSecuritySubscriber($twigMock, $swiftMailerMock, $loggerMock);

        static::assertArrayHasKey(
            'user.created',
            $subscriber::getSubscribedEvents()
        );

        static::assertArrayHasKey(
            'user.validated',
            $subscriber::getSubscribedEvents()
        );
    }

    public function testUserCreatedEventMethod()
    {
        $userCreatedEventMock = $this->getMockBuilder(UserCreatedEvent::class)
                                     ->disableOriginalConstructor()
                                     ->getMock();

        $twigMock = $this->getMockBuilder(Environment::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $swiftMailerMock = $this->getMockBuilder(\Swift_Mailer::class)
                                ->disableOriginalConstructor()
                                ->getMock();

        $loggerMock = $this->getMockBuilder(CoreLoggerInterface::class)
                           ->disableOriginalConstructor()
                           ->getMock();

        $subscriber = new CoreSecuritySubscriber($twigMock, $swiftMailerMock, $loggerMock);

        static::assertNull($subscriber->onUserCreated($userCreatedEventMock));
    }

    public function testUserValidatedEvent()
    {
        $userValidatedEventMock = $this->getMockBuilder(UserValidatedEvent::class)
                                       ->disableOriginalConstructor()
                                       ->getMock();

        $twigMock = $this->getMockBuilder(Environment::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $swiftMailerMock = $this->getMockBuilder(\Swift_Mailer::class)
                                ->disableOriginalConstructor()
                                ->getMock();

        $loggerMock = $this->getMockBuilder(CoreLoggerInterface::class)
                           ->disableOriginalConstructor()
                           ->getMock();

        $subscriber = new CoreSecuritySubscriber($twigMock, $swiftMailerMock, $loggerMock);

        static::assertNull($subscriber->onUserValidated($userValidatedEventMock));
    }
}

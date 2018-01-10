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

namespace App\Tests\Events;

use PHPUnit\Framework\TestCase;
use App\Models\Interfaces\UserInterface;
use App\Events\User\UserForgotPasswordEvent;
use App\Events\Interfaces\UserEventInterface;

/**
 * Class UserForgotPasswordEventTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserForgotPasswordEventTest extends TestCase
{
    public function testClassInjection()
    {
        $userMock = $this->createMock(UserInterface::class);
        $userMock->method('getId')
                 ->willReturn(0);

        $event = new UserForgotPasswordEvent($userMock);

        static::assertInstanceOf(
            UserEventInterface::class,
            $event
        );

        static::assertEquals(
            0,
            $event->getUser()->getId()
        );
    }
}

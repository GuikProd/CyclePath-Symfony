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
use App\Interactors\UserInteractor;
use App\Events\User\UserCreatedEvent;
use App\Events\Interfaces\UserEventInterface;

/**
 * Class UserCreatedEventTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserCreatedEventTest extends TestCase
{
    public function testInstantiation()
    {
        $userAbstract = $this->createMock(UserInteractor::class);
        $userAbstract->method('getId')
                     ->willReturn(98);

        $event = new UserCreatedEvent($userAbstract, '');

        static::assertInstanceOf(
            UserEventInterface::class,
            $event
        );

        static::assertEquals(
            98,
            $event->getUser()->getId()
        );

        static::assertEquals(
            '',
            $event->getMessage()
        );
    }
}

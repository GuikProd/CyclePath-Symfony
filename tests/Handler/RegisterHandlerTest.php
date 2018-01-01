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

namespace App\Tests\Handler;

use App\Builders\UserBuilder;
use PHPUnit\Framework\TestCase;
use App\Handler\RegisterHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegisterHandlerTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterHandlerTest extends TestCase
{
    public function testHandling()
    {
        $entityManagerMock = $this->getMockBuilder(EntityManagerInterface::class)
                                  ->disableOriginalConstructor()
                                  ->getMock();

        $userPasswordEncoderMock = $this->getMockBuilder(UserPasswordEncoderInterface::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();

        $userBuilderMock = $this->getMockBuilder(UserBuilder::class)
                                ->disableOriginalConstructor()
                                ->getMock();

        $handler = new RegisterHandler($entityManagerMock, $userPasswordEncoderMock);

        $formInterfaceMock = $this->getMockBuilder(FormInterface::class)
                                  ->disableOriginalConstructor()
                                  ->getMock();

        static::assertFalse(
            $handler->handle($formInterfaceMock, $userBuilderMock)
        );
    }
}
